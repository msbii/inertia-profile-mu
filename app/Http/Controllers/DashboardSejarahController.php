<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sejarah;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardSejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/sejarah/index',[
    //         'sejarah' => Sejarah::orderBy('created_at', 'desc')->paginate(10),
    //         // 'sejarah' => Sejarah::all(),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Sejarah::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/sejarah/index', [
            'sejarah' => $posts,
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
        return Inertia::render('dashboard/sejarah/create');
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
            'image' => 'image|file|max:2048',
            'body' => 'required'
        ]);
        // check jika img tidak ada maka unsplash
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images','public');
        }

        // Menyimpan data ke dalamm post
        $validateData['user_id'] = auth()->id();
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Sejarah::create($validateData);

        return redirect('/dashboard/sejarah')->with('success', 'Sejarah Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sejarah $sejarah)
    {
        //
        return Inertia::render('dashboard/sejarah/show',[
            'post' => $sejarah,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sejarah $sejarah)
    {
        //
        return Inertia::render('dashboard/sejarah/edit', [
            'post' => $sejarah,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sejarah $sejarah)
    {
        //
        $rules =[
            'title' => 'required|string|max:255',
            'image' => 'image|file|max:2048',
            'body' => 'required',
        ];
        dd("test");
        // validasi data
        $validateData = $request->validate($rules);

        
        // check jika img tidak ada maka unsplash
        if ($request->file('image')) {
            // Menghapus data foto lama supaya berganti baru
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('post-images','public');
        }

        dd('test');

        // Menyimpan data ke dalamm post
        $validateData['user_id'] = auth()->id();
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Sejarah::where('id', $sejarah->id) 
            ->update($validateData);

        return redirect('/dashboard/sejarah')->with('success', 'Sejarah telah Diperbarui!');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sejarah $sejarah)
    {
        // Menghapus data foto lama supaya berganti baru
        if ($sejarah->image) {
            Storage::delete($sejarah->image);
        }

        Sejarah::destroy($sejarah->id);

        return redirect('/dashboard/sejarah')->with('success', 'Sejarah telah Dihapus!');
    }

    // chekslug otomatis mengisi input slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Sejarah::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
