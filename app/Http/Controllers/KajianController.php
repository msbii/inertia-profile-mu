<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Kajian;
use Illuminate\Http\Request;
use App\Models\KategoriKajian;

class KajianController extends Controller
{
    //
    public function index()
    {
        //
        // $firstPost = Kajian::first();
        // dd($firstPost->kategoriKajian->name);
        $kajian = Kajian::with(['kategori_kajian', 'author'])->latest()->filter(request(['search', 'category', 'user']))->paginate(6)->withQueryString();//Load Digunakan N+1 Problem & pagination,
        // dd($kajian);
        $kategori = KategoriKajian::all();
        // dd($kategori);
        return Inertia::render('dashboardPost/kajian/home',[
            "title" => "Single post",
            "active" => "kajian",
            'kajian' => $kajian,
            'pp' => $pp =null,
        ]);
    }

    public function show(Kajian $kajian)
    {
        //
        $kajian->load(['kategori_kajian', 'author']);
        // Dapatkan postingan berdasarkan ID
        $increment = Kajian::findOrFail($kajian->id);

        // Tambahkan 1 ke kolom `click_count`
        $increment->increment('click_count');
        
        $popularKajians = Kajian::orderByDesc('click_count')
                    ->limit(5) // Jumlah postingan yang ingin ditampilkan
                    ->get();
        $allCategory = KategoriKajian::all();

        $latestPosts = Kajian::latest()->take(3)->get(); // Ambil 3 postingan terbaru

        // dd($kajian);
        return Inertia::render('dashboardPost/kajian/detail', [
            "title" => "Single post",
            "active" => "posts",
            "post" => $kajian,
            "popularKajians" => $popularKajians,
            "category" => $allCategory, 
            "latestPosts" => $latestPosts,
        ]);
    }

    public function postByCategory($slug)
    {
        //
        $kategoriKajian = KategoriKajian::where('slug', $slug)
            ->with(['kajians' => function ($query) {
                $query->with('author', 'kategori_kajian'); // Load relasi di dalam kajian
            }])->firstOrFail();

        // dd($kategoriKajian->name);
        // Tampilkan semua kajian di dalam kategori tersebut
        return Inertia::render('dashboardPost/kajian/postBy',[
            'title'=> "Post by Category : $kategoriKajian->name",
            'active' => 'categories',
            // 'posts'=> $kategoriKajian->kajians->load('author','kategoriKajian')//penggunaan load untuk mengatasi N+1 problem
            'posts'=> $kategoriKajian->kajians,//penggunaan load untuk mengatasi N+1 problem
        ]);
    }

    public function postByAuthor(User $author)
    {
        //
        // $author = User::where('username', $author)->with('kajians')->firstOrFail();

        // Tampilkan semua kajian di dalam kategori tersebut
        return Inertia::render('dashboardPost/kajian/postBy',[
            'title'=>"Post by Author : $author->name",
            'active' =>'authors',
            'posts'=> $author->kajians->load('author','kategori_kajian')//penggunaan load untuk mengatasi N+1 problem
        ]);
    }

    public function postBySpeaker($speaker)
    {
        //
        // Tampilkan semua kajian di dalam kategori tersebut
        return Inertia::render('dashboardPost/kajian/postBy',[
            'title'=>"Post by Author : $speaker",
            'active' =>'authors',
            'posts'=> $posts = Kajian::where('speaker', $speaker)->with('author','kategori_kajian')->get(),
        ]);
    }
}
