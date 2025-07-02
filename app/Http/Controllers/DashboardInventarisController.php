<?php

namespace App\Http\Controllers;

use App\Models\Lingkup;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class DashboardInventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     // Menampilkan data berdasarkan user yang login
    //     return Inertia::render('dashboard/inventaris/index',[
    //         'posts' => Inventaris::orderBy('created_at', 'desc')->paginate(10),
            
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Inventaris::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/inventaris/index', [
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
        return Inertia::render('dashboard/inventaris/create',[
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
            'location_id' => 'required',
            'image' => 'image|file|max:2048',
            'description' => 'required',
            'quantity' => 'required',
            'location' => 'required',
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

        Inventaris::create($validateData);

        return redirect('/dashboard/inventaris')->with('success', 'Inventaris Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($inventaris)
    {
        //
        $inventaris = Inventaris::with('Lingkup')->where('slug', $inventaris)->firstOrFail();
        return Inertia::render('dashboard/inventaris/show',[
            'post' => $inventaris,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        //
        dd($slug);
        $inventaris = inventaris::where('slug', $slug)->firstOrFail();
        return Inertia::render('dashboard/inventaris/edit',[
            'post' => $inventaris,
            'categories' => Lingkup::take(2)->get(),
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventaris $inventaris)
    {
        // Ambil data SK berdasarkan slug
        $inventaris = inventaris::where('slug', $inventaris)->firstOrFail();

        // Aturan validasi
        $rules =[
            'title' => 'required|max:255',
            'location_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required',
            'quantity' => 'required',
            'location' => 'required',
        ];

        if ($request->slug != $inventaris->slug) {
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
        Inventaris::where('id', $inventaris->id)->update($validateData);

        return redirect('/dashboard/inventaris')->with('success', 'inventaris telah Diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($inventaris)
    {
        $inventaris = inventaris::where('slug', $inventaris)->firstOrFail();

        // Menghapus data foto lama supaya berganti baru
        if ($inventaris->image) {
            Storage::delete($inventaris->image);
        }

        inventaris::destroy($inventaris->id);

        return redirect('/dashboard/inventaris')->with('success', 'Data Inventaris telah Dihapus!');
    }

    // chekslug otomatis mengisi input slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Inventaris::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
