<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Kajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $profilPenjual = $user;// user id penjual

        $pp=null;

        // Ambil total pengguna dari database
        $totalUsers = User::count();
        
        // Ambil total postingan dari database
        $totalPosts = Post::count();
        
        // Ambil total kajian dari database
        $totalKajians = Kajian::count();

        return Inertia::render('dashboard/Dashboard', [
            // 'pp' => $pp,
            // "totalUsers" => $totalUsers,
            // "totalPosts" => $totalPosts,
            // "totalKajians" => $totalKajians,
        ]);
    }

    public function download($filename)
    {
        $path = 'post-document/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($path);
    }

    public function downloadImage($filename)
    {
        $path = 'post-image/' . $filename;

        if (!Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($path);
    }
}
