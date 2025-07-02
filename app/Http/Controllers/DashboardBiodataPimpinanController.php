<?php

namespace App\Http\Controllers;

use App\Models\Lingkup;
use Illuminate\Http\Request;
use App\Models\BiodataPimpinan;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class DashboardBiodataPimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/biodataPimpinan/index',[
    //         'posts' => BiodataPimpinan::with('position')->orderBy('created_at', 'desc')->get(),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = BiodataPimpinan::with('position')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/biodataPimpinan/index', [
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
        return Inertia::render('dashboard/biodataPimpinan/create',[
            'categories' => Lingkup::take(2)->get(),
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
            'position' => 'required',
            'image' => 'image|file|max:2048',
            'biography' => 'required',
        ]);
        // check jika img tidak ada maka unsplash
        if ($request->file('image')) {
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName(); // Nama asli file dengan timestamp
            $path = $image->storeAs('post-images', $originalName, 'public'); // Simpan ke folder public
            // $validateData['image'] = $originalName; // Simpan nama file ke database
            $validateData['image'] = 'post-images/' . $originalName;
            // $validateData['image'] = $request->file('image')->store('post-images');
        }

        BiodataPimpinan::create($validateData);

        return redirect('/dashboard/biodataPimpinan')->with('success', 'Biodata Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($biodataPimpinan)
    {
        //
        $biodataPimpinan = BiodataPimpinan::with('position')->where('slug', $biodataPimpinan)->firstOrFail();
        return Inertia::render('dashboard/biodataPimpinan/show',[
            'post' => $biodataPimpinan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($biodataPimpinan)
    {
        //
        $biodataPimpinan = BiodataPimpinan::where('slug', $biodataPimpinan)->firstOrFail();
        return Inertia::render('dashboard/biodataPimpinan/edit',[
            'post' => $biodataPimpinan,
            'categories' => Lingkup::take(2)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$biodataPimpinan)
    {
        // Ambil data SK berdasarkan slug
        $biodataPimpinan = BiodataPimpinan::where('slug', $biodataPimpinan)->firstOrFail();

        // Aturan validasi
        $rules =[
            'title' => 'required|max:255',
            'position' => 'required',
            'image' => 'nullable|image|file|max:2048',
            'biography' => 'required',
        ];

        if ($request->slug != $biodataPimpinan->slug) {
            $rules['slug'] = 'required|unique:posts';//tidak dimasukan validasi  karna mengatasi unique
        }

        // validasi data
        $validateData = $request->validate($rules);


        // check jika img tidak ada maka unsplash
        if ($request->file('image')) {
            // Menghapus data foto lama supaya berganti baru
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            //simpan file dengan nama asli
            $image = $request->file('image');
            $originalName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('post-images', $originalName, 'public');
            // $validateData['image'] = $originalName;
            $validateData['image'] = 'post-images/' . $originalName;
            // $validateData['image'] = $request->file('image')->store('post-images');
        }else {
            // Gunakan gambar lama
            $validateData['image'] = $request->oldImage;
        }

        // Update data
        BiodataPimpinan::where('id', $biodataPimpinan->id)->update($validateData);

        return redirect('/dashboard/biodataPimpinan')->with('success', 'Biodata telah Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($biodataPimpinan)
    {
        $biodataPimpinan = BiodataPimpinan::where('slug', $biodataPimpinan)->firstOrFail();

        // Menghapus data foto lama supaya berganti baru
        if ($biodataPimpinan->image) {
            Storage::delete($biodataPimpinan->image);
        }

        BiodataPimpinan::destroy($biodataPimpinan->id);

        return redirect('/dashboard/biodataPimpinan')->with('success', 'Biodata telah Dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(BiodataPimpinan::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
