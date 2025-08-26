<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/posts/index',[
    //         'posts' => Post::with('category')->orderBy('created_at', 'desc')->paginate(10),
    //     ]);
    // }

    public function indexx(Request $request)
    {
        $search = $request->search;

        $posts = Post::with('category')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/posts/index', [
            'posts' => $posts,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $user = auth()->user(); // Ambil user yang sedang login

        $posts = Post::with('category')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($user->role === 'Author' && $user->is_admin != 1, function ($query) use ($user) {
                // Jika Author biasa, tampilkan hanya postingannya sendiri
                $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // Penting agar search tetap terbawa saat pindah halaman

        return Inertia::render('dashboard/posts/index', [
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
        return Inertia::render('dashboard/posts/create',[
            'categories' => Category::all(), 
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
            'image' => 'image|file|max:1024',
            'category_id' => 'required',
            'body' => 'required',
        ]);
    
        // if ($request->file('image')) {
        //     $validateData['image'] = $request->file('image')->store('post-images','public');
        // }

        if ($request->file('image')) 
        {
            // Simpan file asli ke storage/app/public/post-images/original
            $originalPath = $request->file('image')->store('post-images/original', 'public');
            $filename = basename($originalPath);

            // Path thumbnail
            $thumbnailPath = 'post-images/thumbnail/' . $filename;
            $thumbnailFullPath = storage_path('app/public/' . $thumbnailPath);

            // Pastikan folder thumbnail ada
            if (!file_exists(dirname($thumbnailFullPath))) {
                mkdir(dirname($thumbnailFullPath), 0777, true);
            }

            // Buat thumbnail (300x300)
            $image = Image::read($request->file('image'))
                ->cover(300, 300); // crop & resize biar square
            $image->save($thumbnailFullPath);

            // Simpan nama file (nanti bisa dipanggil sebagai asset('storage/post-images/original/'.$filename))
            $validateData['image'] = $filename;
        }
    
        // $validateData['user_id'] = auth()->user()->id();
        $validateData['user_id'] = auth()->id();
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);
    
        Post::create($validateData);
    
        // Response dengan Inertia flash
        return redirect('/dashboard/posts')->with('success', 'Postingan baru telah ditambahkan!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return Inertia::render('dashboard/posts/show',[
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        return Inertia::render('dashboard/posts/edit', [
            'post' => $post,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->method(), $request->all());
        $rules = [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'nullable|image|file|max:2048',
            'body' => 'required'
        ];

        if ($request->slug !== $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        // Proses upload gambar baru
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images', 'public');
        }else {
            $validatedData['image'] = $request->oldImage;
        }

        $validatedData['user_id'] = auth()->id();
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 200);

        $post->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Posting berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        // Menghapus data foto lama supaya berganti baru
        if ($post->image) {
            Storage::delete($post->image);
        }

        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Posting telah dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
