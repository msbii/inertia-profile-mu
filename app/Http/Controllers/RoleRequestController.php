<?php

namespace App\Http\Controllers;

use App\Models\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RoleRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $requests = RoleRequest::with('user')
                ->when($search, function ($query, $search) {
                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                })
                ->where('status', 'pending')
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->withQueryString();
    
        // $requests = RoleRequest::where('status', 'pending')->get();
        return Inertia::render('dashboard/users/role-requests',[
            compact('requests'),
            'requests' => $requests,
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Cek apakah user sudah mengirim permintaan sebelumnya
        $existingRequest = RoleRequest::where('user_id', Auth::id())
                                        ->where('status', 'pending')
                                        ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', 'You have already requested a role change.');
        }

        // Simpan permintaan baru
        RoleRequest::create([
            'user_id' => Auth::id(),
            'requested_role' => 'Author',
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'Your role change request has been submitted.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleRequest $roleRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoleRequest $roleRequest)
    {
        // Setujui atau tolak permintaan
        $status = $request->input('status');
        $roleRequest->update(['status' => $status]);
    
        // Ubah peran pengguna jika disetujui
        if ($status === 'approved') {
            $roleRequest->user->update(['role' => $roleRequest->requested_role]);
        }
    
        return redirect()->back()->with('success', 'Request has been processed.');
    }
    // public function update(Request $request, RoleRequest $roleRequest)
    // {
    //     dd('t');
    //     // Setujui atau tolak permintaan
    //     $status = $request->input('status');
    //     $roleRequest->update(['status' => $status]);
    
    //     // Ubah peran pengguna jika disetujui
    //     if ($status === 'approved') {
    //         $roleRequest->user->update(['role' => $roleRequest->requested_role]);
    //     }
    
    //     return redirect()->back()->with('success', 'Request has been processed.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleRequest $roleRequest)
    {
        //
    }
}
