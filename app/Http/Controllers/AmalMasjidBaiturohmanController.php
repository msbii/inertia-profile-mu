<?php

namespace App\Http\Controllers;

use App\Models\SK;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use App\Models\KategoriKajian;
use App\Models\StrukturOrganisasi;
use Inertia\Inertia;

class AmalMasjidBaiturohmanController extends Controller
{
    //
    public function index()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%Baiturohman%')
        ->get();

        return Inertia::render('dashboardPost/amal/masjidBaiturohman/index', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
        ]);
    }

    public function showSejarah()
    {
        //
        $sejarah = Sejarah::where('slug', 'LIKE', '%' . 'Baiturohman' . '%')->firstOrFail();

        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%Baiturohman%')
        ->get();

        return Inertia::render('dashboardPost/amal/masjidBaiturohman/sejarah', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "post" => $sejarah->load('author'),
        ]);
    }

    public function showSK()
    {
        //

        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%Baiturohman%')
        ->get();

        $sK = SK::where('slug', 'LIKE', '%' . 'Baiturohman' . '%')->firstOrFail();

        return Inertia::render('dashboardPost/amal/masjidBaiturohman/detailSK', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "post" => $sK->load('kategori'),
        ]);
    }
    
    public function showStruktur()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%Baiturohman%')
        ->get();

        $struktur = StrukturOrganisasi::where('slug', 'LIKE', '%' . 'Baiturohman' . '%')->firstOrFail();

        return Inertia::render('dashboardPost/amal/masjidBaiturohman/struktur', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "post" => $struktur->load('kategori'),
        ]);
    }
    public function showKajian($slug)
    {
        //
        $dataKategoriKajian = KategoriKajian::where('slug', $slug)->with('kajians')->firstOrFail();

        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%Baiturohman%')
        ->get();
        
        // //menampilkan data sejarah hanya untuk Baiturohman
        // $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'Baiturohman' . '%')->firstOrFail();

        // Tampilkan semua kajian di dalam kategori tersebut
        return Inertia::render('dashboardPost/amal/masjidBaiturohman/kajian',[
            'title'=> "Post by Category : $dataKategoriKajian->name",
            'active' => 'categories',
            "kategoriKajian" => $kategoriKajian,
            'posts'=> $dataKategoriKajian->kajians->load('author','kategoriKajian')//penggunaan load untuk mengatasi N+1 problem
        ]);
    }
}
