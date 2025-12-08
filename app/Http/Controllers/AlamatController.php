<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AlamatController extends Controller
{
    /**
     * Ambil daftar provinsi dari API EMSIFA (gratis, tanpa API key)
     */
    public function getProvinsi()
    {
        try {
            $response = Http::withoutVerifying()->get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'provinsi' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data provinsi',
                'response' => $response->json(),
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Ambil daftar kota berdasarkan ID provinsi
     *
     * @param int $idProvinsi
     */
    public function getKota($idProvinsi)
    {
        try {
            $response = Http::withoutVerifying()->get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$idProvinsi}.json");

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'kota' => $response->json()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data kota',
                'response' => $response->json(),
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
 * Ambil daftar kecamatan berdasarkan ID kota
 */
public function getKecamatan($idKota)
{
    try {
        $response = Http::withoutVerifying()->get("https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$idKota}.json");

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'kecamatan' => $response->json()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil data kecamatan',
        ], $response->status());
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

/**
 * Ambil daftar kelurahan berdasarkan ID kecamatan
 */
public function getKelurahan($idKecamatan)
{
    try {
        $response = Http::withoutVerifying()->get("https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$idKecamatan}.json");

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'kelurahan' => $response->json()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mengambil data kelurahan',
        ], $response->status());
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

}
