<?php

namespace App\Http\Controllers;

use App\Models\SK;
use Inertia\Inertia;
use App\Models\Sejarah;
use App\Models\Inventaris;
use App\Models\KategoriSK;
use App\Models\Musyawarah;
use Illuminate\Http\Request;
use App\Models\KategoriKajian;
use App\Models\BiodataPimpinan;
use App\Models\PelaksanaProgram;
use App\Models\StrukturOrganisasi;

class MenuMuhammadiyahController extends Controller
{
    //
    public function index()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();
        
        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();
        
        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();
        
        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        return Inertia::render('dashboardPost/menu/muhammadiyah/index', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "pelaksana" => $pelaksana,
            "sejarah" => $datasejarah,
        ]);
    }

    public function showMusyawarah()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();

        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        $musyawarah = Musyawarah::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        return Inertia::render('dashboardPost/menu/muhammadiyah/musyawarah', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "musyawarah" => $musyawarah,
        ]);
    }

    public function detailMusyawarah($slug)
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();

        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        $musyawarah = Musyawarah::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();

        return Inertia::render('dashboardPost/menu/muhammadiyah/detailMusyawarah', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "musyawarah" => $musyawarah->append('time_formatted'),
        ]);
    }

    public function showStruktur()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();

        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        $struktur = StrukturOrganisasi::where('slug', 'LIKE', '%' . 'muhammadiyah' . '%')->firstOrFail();

        //Coba Biodata
        //menampilkan biodataPimpinan Muhammadiyah
        $biodataPimpinan = BiodataPimpinan::with('position')//menghubungkan dengan nama relasi
        ->whereHas('position', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->firstOrFail();
        // dd($biodataPimpinan);
        return Inertia::render('dashboardPost/menu/muhammadiyah/struktur', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "post" => $struktur->load('kategori'),
            //coba biodata
            "biodata" => $biodataPimpinan,
        ]);
    }

    public function showSK($slug)
    {
        //
        // Ambil data SK berdasarkan slug kategori
        $sK = SK::with("kategori")
            ->whereHas('kategori', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->firstOrFail();

        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'Jumat','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();
        
        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk muhammadiyah
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        $listSK = SK::with("kategori")
            ->whereHas('kategori', function ($query) use ($slug) {
            $query->where('slug', 'LIKE', '%' . 'muhammadiyah' . '%');
        })->get();
        

        return Inertia::render('dashboardPost/menu/muhammadiyah/detailSK', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "post" => $sK,
            "listSK" => $listSK,
        ]);
    }

    public function showKajian($slug)
    {
        //
        $dataKategoriKajian = KategoriKajian::where('slug', $slug)->with('kajians')->firstOrFail();

        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'Jumat','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();
        
        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk muhammadiyah
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        // Tampilkan semua kajian di dalam kategori tersebut
        return Inertia::render('dashboardPost/menu/muhammadiyah/kajian',[
            'title'=> "Post by Category : $dataKategoriKajian->name",
            'active' => 'categories',
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            'posts'=> $dataKategoriKajian->kajians->load('author','kategori_kajian')//penggunaan load untuk mengatasi N+1 problem
        ]);
    }

    public function showPelaksana($slug)
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();

        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();

        $pelaksanaProgram  = PelaksanaProgram::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();

        return Inertia::render('dashboardPost/menu/muhammadiyah/pelaksana', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "pelaksanaProgram" => $pelaksanaProgram,
        ]);
    }

    public function showInventaris()
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();

        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();
        
        $inventaris = Inventaris::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();
        
        return Inertia::render('dashboardPost/menu/muhammadiyah/inventaris', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "inventaris" => $inventaris,
        ]);
    }

    public function detailInventaris($slug)
    {
        //
        //menampilkan data kajian hanya untuk muhammadiyah
        $keywords = ['Kamis', 'pon','pimpinan'];
        $query = KategoriKajian::select('slug', 'name');

        foreach ($keywords as $keyword) {
            $query->orWhere('name', 'LIKE', '%' . $keyword . '%');
        }
        $kategoriKajian = $query->get();

        //menampilkan data sk hanya untuk muhammadiyah
        $kategoriSK = KategoriSK::select('slug', 'name')
        ->where('name', 'LIKE', '%muhammadiyah%')
        ->get();

        //menampilkan data sejarah hanya untuk amien
        $datasejarah = Sejarah::where('title', 'LIKE', '%' . 'muhammadiyah' . '%')->get();

        //menampilkan data pelaksana hanya untuk muhammadiyah
        $pelaksana = PelaksanaProgram::with('Lingkup')//menghubungkan dengan nama relasi
        ->whereHas('Lingkup', function ($query) {
            $query->where('name', 'LIKE', '%muhammadiyah%');//mencari kolom nama yang mengandung kata muhammadiyah
        })->get();
        
        $inventaris = inventaris::where('slug', 'LIKE', '%' . $slug . '%')->firstOrFail();
        
        return Inertia::render('dashboardPost/menu/muhammadiyah/detailInventaris', [
            "title" => "Single post",
            "active" => "posts",
            "kategoriKajian" => $kategoriKajian,
            "kategoriSK" => $kategoriSK,
            "sejarah" => $datasejarah,
            "pelaksana" => $pelaksana,
            "inventaris" => $inventaris,
        ]);
    }
}
