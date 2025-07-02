<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Nette\Schema\Elements\Structure;
use Illuminate\Support\Facades\Storage;
use App\Models\KategoriStrukturOrganisasi;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class DashboardStrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/struktur/index',[
    //         'posts' => StrukturOrganisasi::with('kategori')->orderBy('created_at', 'desc')->get(),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = StrukturOrganisasi::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/struktur/index', [
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
        return Inertia::render('dashboard/struktur/create',[
            'categories' => KategoriStrukturOrganisasi::all(),
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
            'kategori_id' => 'required',
            'image' => 'image|file|max:2048',
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

        StrukturOrganisasi::create($validateData);

        return redirect('/dashboard/struktur')->with('success', 'Struktur Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($strukturOrganisasi)
    {
        //
        $strukturOrganisasi = StrukturOrganisasi::with('kategori')->where('slug', $strukturOrganisasi)->firstOrFail();
        return Inertia::render('dashboard/struktur/show',[
            'post' => $strukturOrganisasi,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $strukturOrganisasi)
    {
        //
        $sK = StrukturOrganisasi::where('slug', $strukturOrganisasi)->firstOrFail();
        return Inertia::render('dashboard/struktur/edit',[
            'post' => $sK,
            'categories' => KategoriStrukturOrganisasi::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$strukturOrganisasi)
    {
        // Ambil data SK berdasarkan slug
        $sK = StrukturOrganisasi::where('slug', $strukturOrganisasi)->firstOrFail();

        dd($sK);
        // Aturan validasi
        $rules =[
            'title' => 'required|max:255',
            'kategori_id' => 'required',
            'image' => 'nullable|image|file|max:2048',
        ];

        if ($request->slug != $sK->slug) {
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
        StrukturOrganisasi::where('id', $sK->id)->update($validateData);

        // return Inertia::location(route('dashboard.posts.index'))->with('success', 'Data Struktur telah Diperbarui!');
        return redirect('/dashboard/struktur')->with('success', 'Data Struktur telah Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $strukturOrganisasi)
    {
        $sK = StrukturOrganisasi::where('slug', $strukturOrganisasi)->firstOrFail();

        // Menghapus data foto lama supaya berganti baru
        if ($sK->image) {
            Storage::delete($sK->image);
        }

        StrukturOrganisasi::destroy($sK->id);

        return redirect('/dashboard/struktur')->with('success', 'Data Struktur telah Dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(StrukturOrganisasi::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
