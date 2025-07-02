<?php

namespace App\Http\Controllers;

use App\Models\Lingkup;
use Illuminate\Http\Request;
use App\Models\PelaksanaProgram;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class DashboardPelaksanaanProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/pelaksanaProgram/index',[
    //         'posts' => pelaksanaProgram::with('Lingkup')->orderBy('created_at', 'desc')->paginate(10),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = PelaksanaProgram::with('Lingkup')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/pelaksanaProgram/index', [
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
        return Inertia::render('dashboard/pelaksanaProgram/create',[
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
            'lingkup_id' => 'required',
            'image' => 'image|file|max:2048',
            'name' => 'required',
            'description' => 'required',
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

        PelaksanaProgram::create($validateData);

        return redirect('/dashboard/pelaksanaanProgram')->with('success', 'Data Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($pelaksanaProgram)
    {
        //
        $pelaksanaProgram = PelaksanaProgram::with('Lingkup')->where('slug', $pelaksanaProgram)->firstOrFail();
        return Inertia::render('dashboard/pelaksanaProgram/show',[
            'post' => $pelaksanaProgram,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pelaksanaProgram)
    {
        //
        $pelaksanaProgram = PelaksanaProgram::where('slug', $pelaksanaProgram)->firstOrFail();
        return Inertia::render('dashboard/pelaksanaProgram/edit',[
            'post' => $pelaksanaProgram,
            'categories' => Lingkup::take(2)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$pelaksanaProgram)
    {
        // Ambil data SK berdasarkan slug
        $pelaksanaProgram = pelaksanaProgram::where('slug', $pelaksanaProgram)->firstOrFail();

        // Aturan validasi
        $rules =[
            'title' => 'required|max:255',
            'lingkup_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name' => 'required',
            'description' => 'required',
        ];

        if ($request->slug != $pelaksanaProgram->slug) {
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
        pelaksanaProgram::where('id', $pelaksanaProgram->id)->update($validateData);

        return redirect('/dashboard/pelaksanaanProgram')->with('success', 'Data telah Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pelaksanaProgram)
    {
        $pelaksanaProgram = pelaksanaProgram::where('slug', $pelaksanaProgram)->firstOrFail();

        // Menghapus data foto lama supaya berganti baru
        if ($pelaksanaProgram->image) {
            Storage::delete($pelaksanaProgram->image);
        }

        pelaksanaProgram::destroy($pelaksanaProgram->id);

        return redirect('/dashboard/pelaksanaanProgram')->with('success', 'Data telah Dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(PelaksanaProgram::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
