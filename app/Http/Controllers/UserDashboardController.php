<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $pendingOrdersCount = \App\Models\Pesanan::where('user_id', $user->id)
        ->where('status', '!=', 'selesai')
        ->count();

    // Cek apakah notifikasi sudah ditutup di session
    $hidePendingNotif = session('hide_pending_notif', false);

    return view('user.dashboard', compact('user', 'pendingOrdersCount', 'hidePendingNotif'));
}

}
