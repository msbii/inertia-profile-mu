<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/categories/index',[
    //         // 'categories' => Category::all(),
    //         'categories' => Category::orderBy('created_at', 'desc')->get(),
    //         // 'posts' => Post::with('category')->orderBy('created_at', 'desc')->paginate(10),
    //     ]);
    // }

    public function index(Request $request)
    {
        $search = $request->search;

        $categories = Category::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
        ->paginate(10)
        ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/categories/index', [
            'categories' => $categories,
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
        return Inertia::render('dashboard/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories',

        ]);
        
        // Simpan data produk baru ke dalam database
        Category::create($validatedData);
        
        return redirect('/dashboard/categories')->with('success', 'Item berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return Inertia::render('dashboard/categories/edit',[
            'categories' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {   
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'slug'=> Str::slug($request->name),
        ]);

        // // Find the product by ID
        $category = category::findOrFail($category->id);

        // Update product details
        $category->name = $validatedData['name'];
        // $category->slug = $request->name;

        // Save the changes
        $category->save();

        return redirect('/dashboard/categories')->with('success', 'Item berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }

    //chekslug otomatis
    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
