<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Lingkup;
use App\Models\Musyawarah;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardMusyawarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/musyawarah/index',[
    //         'posts' => musyawarah::orderBy('created_at', 'desc')->paginate(10),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Musyawarah::query()
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/musyawarah/index', [
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
        return Inertia::render('dashboard/musyawarah/create',[
            'categories' => Lingkup::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'lingkup_id' => 'required',
            'image' => 'image|file|max:2048',
            'time' => 'required',
            'location' => 'required',
            'agenda' => 'required',
            'hasil' => 'required',
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

        Musyawarah::create($validateData);

        return redirect('/dashboard/musyawarah')->with('success', 'Data Musyawarah Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($musyawarah)
    {
        //
        $musyawarah = Musyawarah::with('Lingkup')->where('slug', $musyawarah)->firstOrFail();
        $post = $musyawarah->toArray();
        $post['waktu'] = Carbon::parse($musyawarah->waktu)->translatedFormat('d F Y, H:i');
        return Inertia::render('dashboard/musyawarah/show',[
            'post' => $post,
    
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $musyawarah)
    {
        //
        $musyawarah = musyawarah::where('slug', $musyawarah)->firstOrFail();
        return Inertia::render('dashboard/musyawarah/edit',[
            'post' => $musyawarah,
            'categories' => Lingkup::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$musyawarah)
    {
        // Ambil data SK berdasarkan slug
        $musyawarah = musyawarah::where('slug', $musyawarah)->firstOrFail();

        // Aturan validasi
        $rules =[
            'title' => 'required|max:255',
            'lingkup_id' => 'required',
            'image' => 'image|file|max:2048',
            'time' => 'required',
            'location' => 'required',
            'agenda' => 'required',
            'hasil' => 'required',
        ];

        if ($request->slug != $musyawarah->slug) {
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
        musyawarah::where('id', $musyawarah->id)->update($validateData);

        return redirect('/dashboard/musyawarah')->with('success', 'Data Musyawarah telah Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($musyawarah)
    {
        $musyawarah = musyawarah::where('slug', $musyawarah)->firstOrFail();

        // Menghapus data foto lama supaya berganti baru
        if ($musyawarah->image) {
            Storage::delete($musyawarah->image);
        }

        musyawarah::destroy($musyawarah->id);

        return redirect('/dashboard/musyawarah')->with('success', 'Data musyawarah telah Dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Musyawarah::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
