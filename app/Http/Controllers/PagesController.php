<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function index(){
        $title = "homee";
        return Inertia::render('Home',[
            "title" => "$title",
        ]); 
    }

    public function postByKabar(){
        $title = "kabar";
        return Inertia::render('dashboardPost.kabar.home',[
            "title" => "$title",
        ]); 
    }
}
