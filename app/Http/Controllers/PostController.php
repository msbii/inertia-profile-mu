<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Kajian;
use App\Models\Sejarah;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function indexi()
    {
        //
        // $cek = User::with('roleRequest')
        // ->whereHas('roleRequest', function ($query) {
        //     $query->where('status', 'pending');
        // })
        // ->get();
        // $cek = Auth::user()->load(['roleRequest']);
        // dd($cek);

        //Detail judul
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in '. $category->name;
        }
        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = ' in '. $user->name;
        }

        $posts = Post::with(['category', 'author'])->latest()->filter(request(['search', 'category', 'user']))->paginate(6)->withQueryString();//Load Digunakan N+1 Problem & pagination

        $latestPosts = Post::latest()->take(3)->get(); // Ambil 3 postingan terbaru

        $popularPosts = Post::orderByDesc('click_count')
                    ->limit(4) // Jumlah postingan yang ingin ditampilkan
                    ->get();
        
        $showKabar = Post::whereHas('category', function ($query) {
            $query->where('name', 'kabar');
        })->latest()->take(6)->get(); // Ambil 3 postingan terbaru
        
        $showHukum = Post::whereHas('category', function ($query) {
            $query->where('name', 'like', '%' . 'hukum' . '%');
        })->latest()->take(3)->get(); // Ambil 3 postingan terbaru

        $showKajian = Kajian::latest()->take(3)->get(); // Ambil 3 postingan terbaru
        // $posts = post::all();
        // dd($posts);
        return Inertia::render('dashboardPost/posts/home',[
            "title" => "All Posts" . $title,
            "active" => "posts",
            // "posts" => \App\Models\Post::all() 
            // mengurutkan data terakhir masuk
            "posts" => $posts,
            "latestPosts" => $latestPosts,
            "popularPosts" => $popularPosts,
            "showKabar" => $showKabar,
            "showHukum" => $showHukum,
            "showKajian" => $showKajian,
        ]);
    }

    public function index(Request $request)
    {

        //Detail judul
        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in '. $category->name;
        }
        if (request('user')) {
            $user = User::firstWhere('username', request('user'));
            $title = ' in '. $user->name;
        }

        // $posts = Post::with(['category', 'author'])->latest()->filter(request(['search', 'category', 'user']))->paginate(6)->withQueryString();//Load Digunakan N+1 Problem & pagination
        $posts = Post::with(['category', 'author'])
        ->latest()
        ->filter($request->only('search', 'category', 'user'))
        ->paginate(6)
        ->withQueryString();

        $latestPosts = Post::latest()->take(3)->get(); // Ambil 3 postingan terbaru

        $popularPosts = Post::orderByDesc('click_count')
                    ->limit(4) // Jumlah postingan yang ingin ditampilkan
                    ->get();
        
        $showKabar = Post::whereHas('category', function ($query) {
            $query->where('name', 'kabar');
        })->latest()->take(6)->get(); // Ambil 3 postingan terbaru
        
        $showHukum = Post::whereHas('category', function ($query) {
            $query->where('name', 'like', '%' . 'hukum' . '%');
        })->latest()->take(3)->get(); // Ambil 3 postingan terbaru

        $showKajian = Kajian::latest()->take(3)->get(); // Ambil 3 postingan terbaru
        // $posts = post::all();
        // dd($posts);
        return Inertia::render('dashboardPost/posts/home',[
            "title" => "All Posts" . $title,
            "active" => "posts",
            // "posts" => \App\Models\Post::all() 
            // mengurutkan data terakhir masuk
            "posts" => $posts,
            "latestPosts" => $latestPosts,
            "popularPosts" => $popularPosts,
            "showKabar" => $showKabar,
            "showHukum" => $showHukum,
            "showKajian" => $showKajian,
            'filters' => $request->only('search', 'category', 'user'),
        ]);
    }

    public function show(Post $post)
    {
        $post->load(['author', 'category']);
        // Dapatkan postingan berdasarkan ID
        $increment = Post::findOrFail($post->id);

        // Tambahkan 1 ke kolom `click_count`
        $increment->increment('click_count');
        
        $popularPosts = Post::orderByDesc('click_count')
                    ->limit(5) // Jumlah postingan yang ingin ditampilkan
                    ->get();
        
        $category = Category::all();

        $latestPosts = Post::latest()->take(3)->get(); // Ambil 3 postingan terbaru

        // dd($latestPosts);
        return Inertia::render('dashboardPost/posts/detail', [
            "title" => "Single post",
            "active" => "posts",
            "post" => $post,
            "increment" => $increment,
            "popularPosts" => $popularPosts,
            "category" => $category,
            "latestPosts" => $latestPosts,
        ]);
    }

    public function postByCategory(Category $category)
    {
        //
        return Inertia::render('dashboardPost/posts/postBy',[
            'title'=> "Post by Category : $category->name",
            'active' => 'categories',
            'posts'=> $category->posts->load('author','category')//penggunaan load untuk mengatasi N+1 problem
        ]);
    }
    public function postByAuthor(User $author)
    {
        //
        // dd($author);
        return Inertia::render('dashboardPost/posts/postBy',[
            'title'=>"Post by Author : $author->name",
            'active' =>'authors',
            'posts'=> $author->posts->load('author','category')//penggunaan load untuk mengatasi N+1 problem
        ]);
    }

    public function postByKabar()
    {
        $allCategory = Category::all();
        $category = Category::firstWhere('slug', 'kabar');

        $latestPosts = Post::whereHas('category', function ($query) {
            $query->where('name', 'kabar');
        })->latest()->take(3)->get(); // Ambil 3 postingan terbaru
        
        return Inertia::render('dashboardPost/kabar/home',[
            'title'=> "Post by Category : $category->name",
            'active' => 'categories',
            'posts'=> $category->posts->load('author','category'),//penggunaan load untuk mengatasi N+1 problem
            "category" => $allCategory,
            "latestPosts" => $latestPosts,
        ]);
    }

    public function cekHome(){
        $test = Sejarah::where('title', 'like', '%Muhammadiyah%')
            ->orWhere('title', 'like', '%Aisyiyah%')
            ->get();
        // dd($test);
        $title = "homee";
        return Inertia::render('Home',[
            "title" => "$title",
            "sejarah" => $test,
        ]); 
    }
}
