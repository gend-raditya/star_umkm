<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Path ke sertifikat
        $certPath = base_path('cert/cacert.pem');

        // Validasi apakah file ada
        if (!file_exists($certPath)) {
            Log::error("MidtransService: File cacert.pem tidak ditemukan di $certPath");
            throw new \Exception("File cacert.pem tidak ditemukan. Pastikan sertifikat SSL tersedia.");
        }

        // Set konfigurasi cURL lengkap
        Config::$curlOptions = [
            CURLOPT_CAINFO => $certPath,
            CURLOPT_HTTPHEADER => [] // ✅ tambahkan ini agar tidak error saat merge
        ];
    }

    public function createTransaction($orderId, $amount, $customer)
    {
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $amount,
            ],
            'customer_details' => $customer,
        ];

        $snap = Snap::createTransaction($params);
        return $snap->token; // kirim Snap Token bukan URL

    }
}
