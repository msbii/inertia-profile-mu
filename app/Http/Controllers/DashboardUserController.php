<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     //
    //     return Inertia::render('dashboard/users/index',[
    //         'user' => User::orderBy('created_at', 'desc')->paginate(10),
    //     ]);
    // }

    
    public function index(Request $request)
    {
        $search = $request->search;

        $user = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // penting agar paginasi tetap membawa parameter search
            // ->latest()
            // ->get();

        return Inertia::render('dashboard/users/index', [
            'user' => $user,
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
        return Inertia::render('dashboard/users/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return Inertia::render('dashboard/users/edit', [
            'post' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user)
    {
        $user = User::where('id', $user)->firstOrFail();
        // Validasi data dari form Inertia
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'is_admin' => 'required|in:0,1',
        ]);

        // Update data
        $user->update($validatedData);

        // Redirect ke halaman dengan pesan sukses (Inertia otomatis handle flash)
        return redirect('dashboard/users/index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        User::destroy($user->id);
        // Redirect ke halaman lain atau kembali ke halaman sebelumnya
        return redirect('/dashboard/user')->with('success', 'Item berhasil dihapus ya.');
    }

    // public function export()
    // {
    //     return Excel::download(new UsersExport, 'users.xlsx');
    // }

    public function export(Request $request)
    {
        $search = $request->search;

        return Excel::download(new UsersExport($search), 'users.xlsx');
    }
}
