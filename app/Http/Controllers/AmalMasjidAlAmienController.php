<?php

namespace App\Http\Controllers;

use App\Models\SK;
use Inertia\Inertia;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use App\Models\KategoriKajian;
use App\Models\StrukturOrganisasi;

class AmalMasjidAlAmienController extends Controller
{
    //
    public function index()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%amien%')
        ->get();

        return Inertia::render('dashboardPost/amal/masjidAlAmien/index', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
        ]);
    }

    public function showSejarah()
    {
        //
        $sejarah = Sejarah::where('slug', 'LIKE', '%' . 'amien' . '%')->firstOrFail();

        //menampilkan data kajian hanya untuk muhammadiyah
        $kategoriKajian = KategoriKajian::select('slug', 'name')
        ->where('name', 'LIKE', '%amien%')
        ->get();

        return Inertia::render('dashboardPost/amal/masjidAlAmien/sejarah', [
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
        ->where('name', 'LIKE', '%amien%')
        ->get();

        $sK = SK::where('slug', 'LIKE', '%' . 'amien' . '%')->firstOrFail();

        return Inertia::render('dashboardPost/amal/masjidAlAmien/detailSK', [
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
        ->where('name', 'LIKE', '%amien%')
        ->get();

        $struktur = StrukturOrganisasi::where('slug', 'LIKE', '%' . 'amien' . '%')->firstOrFail();

        return Inertia::render('dashboardPost/amal/masjidAlAmien/struktur', [
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
        ->where('name', 'LIKE', '%amien%')
        ->get();
        
        // //menampilkan data sejarah hanya untuk amien
        // $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'amien' . '%')->firstOrFail();

        // Tampilkan semua kajian di dalam kategori tersebut
        return Inertia::render('dashboardPost/amal/masjidAlAmien/kajian',[
            'title'=> "Post by Category : $dataKategoriKajian->name",
            'active' => 'categories',
            "kategoriKajian" => $kategoriKajian,
            'posts'=> $dataKategoriKajian->kajians->load('author','kategori_kajian')//penggunaan load untuk mengatasi N+1 problem
        ]);
    }
}
