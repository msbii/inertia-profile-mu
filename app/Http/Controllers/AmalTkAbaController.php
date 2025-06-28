<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sejarah;
use App\Models\Category;
use App\Models\post;
use Illuminate\Http\Request;

class AmalTkAbaController extends Controller
{
    //
    public function index()
    {
        //
        
        return Inertia::render('dashboardPost/amal/tkAba/index', [
            "title" => "Single post",
            "active" => "posts",
        ]);
    }

    public function sejarah()
    {
        //
        $sejarah = Sejarah::where('slug', 'LIKE', '%' . 'tk' . '%')->firstOrFail();

        return Inertia::render('dashboardPost/amal/tkAba/sejarah', [
            "title" => "Single post",
            "active" => "posts",
            "post" => $sejarah->load('author'),
        ]);
    }

    public function prestasi()
    {
        //
        $prestasi = Category::firstWhere('slug', 'LIKE', '%' . 'prestasi' . '%');

        return Inertia::render('dashboardPost/amal/tkAba/prestasi', [
            "title" => "Single post",
            "active" => "posts",
            "prestasi" => $prestasi->posts->load('author','category'),//penggunaan load untuk mengatasi N+1 problem,
        ]);
    }

    public function detailPrestasi($slug)
    {
        //
        $prestasi = post::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();

        return Inertia::render('dashboardPost/amal/tkAba/detailPrestasi', [
            "title" => "Single post",
            "active" => "posts",
            "prestasi" => $prestasi,
        ]);
    }
}
