<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // ambil produk terbaru (misal 6 item)
        $produkTerbaru = Produk::latest()->take(6)->get();

        return view('landing_page', compact('produkTerbaru'));
    }

    public function galeri()
    {
        return view('user.galeri');
    }

    public function tentang()
    {
        return view('user.tentang');
    }
}
