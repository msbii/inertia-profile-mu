<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Category;
use App\Models\Musyawarah;
use App\Models\Post;
use Illuminate\Http\Request;

class MenuAngkatanMudaController extends Controller
{
    //
    public function index()
    {
        //

        return Inertia::render('dashboardPost/menu/angkatanMuda/index', [
            "title" => "Single post",
            "active" => "posts",
        ]);
    }

    public function showMusyawarah()
    {
        //
        $musyawarah = Musyawarah::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muda%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        return Inertia::render('dashboardPost/menu/angkatanMuda/musyawarah', [
            "title" => "Single post",
            "active" => "posts",
            "judul" => "Musyawarah", 
            "posts" => $musyawarah,
        ]);
    }

    public function detailMusyawarah($slug)
    {
        //
        $musyawarah = Musyawarah::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();

        return Inertia::render('dashboardPost/menu/angkatanMuda/detailMusyawarah', [
            "title" => "Single post",
            "active" => "posts",
            "musyawarah" => $musyawarah,
        ]);
    }

    public function showPemuda()
    {
        //
        $syiar = Category::firstWhere('slug', 'LIKE', '%' . 'syiar' . '%');

        return Inertia::render('dashboardPost/menu/angkatanMuda/pemuda', [
            "title" => "Single post",
            "active" => "posts",
            "judul" => "Syiar", 
            "posts" => $syiar->posts->load('author','category'),//penggunaan load untuk mengatasi N+1 problem,,
        ]);
    }

    public function showSyiar()
    {
        //
        $syiar = Category::firstWhere('slug', 'LIKE', '%' . 'syiar' . '%');

        return Inertia::render('dashboardPost/menu/angkatanMuda/syiar', [
            "title" => "Single post",
            "active" => "posts",
            "judul" => "Syiar", 
            "posts" => $syiar->posts->load('author','category'),//penggunaan load untuk mengatasi N+1 problem,,
        ]);
    }

    public function detailSyiar($slug)
    {
        //
        $syiar = Post::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();

        return Inertia::render('dashboardPost/menu/angkatanMuda/detailSyiar', [
            "title" => "Single post",
            "active" => "posts",
            "judul" => "Syiar", 
            "syiar" => $syiar,
        ]);
    }

    public function showBaksos()
    {
        //
        $baksos = Category::firstWhere('slug', 'LIKE', '%' . 'bakti' . '%');

        return Inertia::render('dashboardPost/menu/angkatanMuda/baksos', [
            "title" => "Single post",
            "active" => "posts",
            "judul" => "Bakti Sosial Idul Adha", 
            "posts" => $baksos->posts->load('author','category'),//penggunaan load untuk mengatasi N+1 problem,,
        ]);
    }

    public function detailBaksos($slug)
    {
        //
        $Baksos = Post::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();

        return Inertia::render('dashboardPost/menu/angkatanMuda/detailBaksos', [
            "title" => "Single post",
            "active" => "posts",
            "judul" => "Bakti Sosial Idul Adha", 
            "baksos" => $Baksos,
        ]);
    }
}
