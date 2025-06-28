<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Sejarah;
use Illuminate\Http\Request;

class SejarahController extends Controller
{
    //
    public function show(Sejarah $sejarah)
    {
        //
        // $sejarahPosts = Post::whereIn('title', ['Muhammadiyah', 'Aisyiyah'])->get(); // Misalnya ambil postingan Muhammadiyah & Aisyiyah

        // dd($sejarah);
        // return view('sejarah.index', compact('sejarahPosts'));
        return Inertia::render('dashboardPost/sejarah/home', [
            "title" => "Single post",
            "active" => "posts",
            "post" => $sejarah
        ]);
    }
}
