<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSellerController extends Controller
{
     public function index()
    {
        // Hanya tampilkan user yang sudah mengajukan jadi seller (status pending)
        $sellers = User::whereNotNull('seller_status')
            ->where('seller_status', 'pending')
            ->get();

        return view('admin.sellers.index', compact('sellers'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->is_seller = true;
        $user->seller_status = 'approved';
        $user->save();

        return back()->with('success', 'Seller disetujui!');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->is_seller = false;
        $user->seller_status = 'rejected';
        $user->save();

        return back()->with('info', 'Pengajuan seller ditolak.');
    }
}
