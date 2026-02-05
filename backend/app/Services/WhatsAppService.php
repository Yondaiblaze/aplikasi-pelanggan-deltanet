<?php

namespace App\Services;

class WhatsAppService
{

    public function sendMessage($phone, $message)
    {
        $curl = curl_init();

        // Mengambil data dari .env sesuai saran bapak atasan
        $url = env('WA_URL');
        $auth = env('WA_AUTH');

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url, // Tidak lagi nulis IP manual di sini
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "phone" => $phone,
                "message" => $message
            ]),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: ' . $auth // Tidak lagi nulis kode Basic manual di sini
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
