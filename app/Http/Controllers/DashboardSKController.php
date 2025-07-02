<?php

namespace App\Http\Controllers;

use App\Models\SK;
use App\Models\KategoriSK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class DashboardSKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/sk/index',[
    //         'posts' => SK::with('kategori')->orderBy('created_at', 'desc')->get(),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = SK::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/sk/index', [
            'posts' => $posts,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('dashboard/sk/create',[
            'categories' => KategoriSK::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');

        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'kategori_sk_id' => 'required',
            'tahun' => 'required',
            'document' => 'required|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ]);

        if ($request->file('document')) {
            $document = $request->file('document');
            $originalName = time() . '_' . $document->getClientOriginalName(); // Nama asli file dengan timestamp
            $path = $document->storeAs('post-document', $originalName, 'public'); // Simpan ke folder public
            $validateData['document'] = $originalName; // Simpan nama file ke database
        }
       
        SK::create($validateData);

        return redirect('/dashboard/sk')->with('success', 'Data SK Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($sK)
    {
        //
        $sK = SK::with('kategori')->where('slug', $sK)->firstOrFail();
        return Inertia::render('dashboard/sk/show',[
            'post' => $sK,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $sK)
    {
        //
        $sK = SK::where('slug', $sK)->firstOrFail();
        return Inertia::render('dashboard/sk/edit',[
            'post' => $sK,
            'categories' => KategoriSK::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sK)
    {
        // Ambil data SK berdasarkan slug
        $sK = SK::where('slug', $sK)->firstOrFail();

        // Aturan validasi
        $rules =[
            'title' => 'required|max:255',
            'kategori_sk_id' => 'required',
            'tahun' => 'required',
            'document' => 'nullable|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ];

        if ($request->slug != $sK->slug) {
            $rules['slug'] = 'required|unique:posts';//tidak dimasukan validasi  karna mengatasi unique
        }

        // validasi data
        $validateData = $request->validate($rules);


        // Jika ada file baru
        if ($request->file('document')) {
            // Hapus file lama jika ada
            if ($sK->document) {
                Storage::disk('public')->delete('post-document/' . $sK->document);
            }

            // Simpan file baru
            $document = $request->file('document');
            $originalName = time() . '_' . $document->getClientOriginalName();
            $path = $document->storeAs('post-document', $originalName, 'public');
            $validateData['document'] = $originalName;
        }else {
            // Gunakan gambar lama
            $validateData['document'] = $request->olddocument;
        }

        // Update data
        SK::where('id', $sK->id)->update($validateData);

        return redirect('/dashboard/sk')->with('success', 'Data SK telah Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sK)
    {
        $sK = SK::where('slug', $sK)->firstOrFail();
        // dd($sK);
        // Menghapus data file lama supaya berganti baru
        if ($sK->document) {
            Storage::delete($sK->document);
        }

        SK::destroy($sK->id);
        // $sK->delete();

        return redirect('/dashboard/sk')->with('success', 'Data SK telah Dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(SK::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
