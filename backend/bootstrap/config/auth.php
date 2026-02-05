<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt', // Menggunakan JWT untuk autentikasi token
            'provider' => 'users', // Merujuk ke provider 'users' di bawah
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            // Kita gunakan model User yang sudah kita sinkronkan ke tabel customers tadi
            'model' => App\Models\User::class,
        ],
    ],
];
