<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriKajian;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Inertia\Inertia;

class DashboardKajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/kajians/index',[
    //         // 'posts' => Kajian::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get(),
    //         'posts' => Kajian::with('kategori_kajian')->orderBy('created_at', 'desc')->paginate(10),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $posts = Kajian::with('kategori_kajian')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/kajians/index', [
            'posts' => $posts,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return Inertia::render('dashboard/kajians/create',[
            'categories' => KategoriKajian::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');

        $validateData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'speaker' => 'max:55',
            'image' => 'image|file|max:2048',
            'category_id' => 'required',
            'body' => 'required',
            'document'=> 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ]);
        // check jika img tidak ada maka unsplash
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images','public');
        }

        // // Mengambil file dari request
        // $document = $request->file('document');
        // // Menyimpan file ke folder 'post-document' dalam penyimpanan default Laravel ('storage/app/post-document')
        // $path = $document->store('post-document');
        // // $path akan berisi path relatif ke penyimpanan, misalnya "post-document/nama_file_unik.pdf"
        // // Jika Anda perlu mendapatkan nama file untuk disimpan di database atau menampilkan file, gunakan basename()
        // $nama_document = basename($path);

        if ($request->file('document')) {
            $document = $request->file('document');

            // Buat nama file yang aman dan unik
            $originalName = time() . '_' . $document->getClientOriginalName();

            // Simpan ke folder storage/app/public/post-document/
            $path = $document->storeAs('public/post-document', $originalName);

            // Simpan hanya 'post-document/namafile.ext' ke database
            $validateData['document'] = str_replace('public/post-document/', '', $path);
        }
        
        // Mengambil file dari request
        // if($request->file('document')){

        //     $document = $request->file('document');
        //     // Mendapatkan nama asli file
        //     $originalName = time() . '_' . $document->getClientOriginalName();
        //     // Menyimpan file dengan nama asli ke folder 'post-document'
        //     $path = $document->storeAs('post-document', $originalName);
        //     $validateData['document'] = $originalName;
        // }

        // $document = $request->file('document');
        // // $nama_document = 'Kajian'.date('Ymdhis').'.'.$request->file('document')
        // // ->getClientOriginalExtension();
        // // Menambahkan timestamp untuk mencegah nama file duplikat
        // $nama_document = time() . '_' . $document->getClientOriginalName();
        // $document->move('dokumen/',$nama_document);

        // Menyimpan data ke dalamm post
        $validateData['user_id'] = auth()->id();
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200); 

        Kajian::create($validateData);

        return redirect('/dashboard/kajian')->with('success', 'Kajian Baru Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kajian $kajian)
    {
        //
        return Inertia::render('dashboard/kajians/show',[
            'post' => $kajian->load(['kategori_kajian', 'author']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kajian $kajian)
    {
        //
        return Inertia::render('dashboard/kajians/edit',[
            'post' => $kajian,
            'categories' => KategoriKajian::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kajian $kajian)
    {
        //
        
        $rules =[
            'title' => 'required|max:255',
            'speaker' => 'max:55',
            'category_id' => 'required',
            'image' => 'image|file|max:2048',
            'body' => 'required',
            'document'=> 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ];

        if ($request->slug != $kajian->slug) {
            $rules['slug'] = 'required|unique:posts';//tidak dimasukan validasi  karna mengatasi unique
        }

        // validasi data
        $validateData = $request->validate($rules);
dd('test');
        
        // check jika img tidak ada maka unsplash
        if ($request->file('image')) {
            // Menghapus data foto lama supaya berganti baru
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('post-images');
        }

        if ($request->file('document')) {
            // Mengambil file dari request
            $document = $request->file('document');
            // Mendapatkan nama asli file
            $originalName = time() . '_' . $document->getClientOriginalName();
            // Menyimpan file dengan nama asli ke folder 'post-document'
            $path = $document->storeAs('post-document', $originalName);
            $validateData['document'] = $originalName;
        }
        
        // Menyimpan data ke dalamm post
        $validateData['user_id'] = auth()->id();
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        
        Kajian::where('id', $kajian->id) 
            ->update($validateData);

        return redirect('/dashboard/kajian')->with('success', 'Kajian telah Diperbarui!');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kajian $kajian)
    {
        // Menghapus data foto lama supaya berganti baru
        if ($kajian->image) {
            Storage::delete($kajian->image);
        }
        // Menghapus data file lama supaya berganti baru
        if ($kajian->document) {
            Storage::delete($kajian->document);
        }

        Kajian::destroy($kajian->id);

        return redirect('/dashboard/kajian')->with('success', 'Kajian telah Dihapus!');
    }

    // chekslug otomatis mengisi input slug
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kajian::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
