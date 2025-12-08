<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSellerController extends Controller
{
    public function index()
    {
        // Ambil semua seller yang baru daftar (pending)
        $sellers = Seller::with('user')
            ->whereHas('user', function ($q) {
                $q->where('seller_status', 'pending');
            })
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
    //melihat daftar seller yg disetujui
    public function approved()
    {
        // Ambil SEMUA seller yang sudah disetujui
        $sellers = \App\Models\Seller::whereHas('user', function ($q) {
            $q->where('seller_status', 'approved');
        })->with('user')->get();

        return view('admin.sellers.approved', compact('sellers'));
    }
}
