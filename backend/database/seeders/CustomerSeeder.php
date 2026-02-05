<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer; // Pastikan model Customer sudah ada

class CustomerSeeder extends Seeder
{
    public function run()
    {
        // Menghapus data lama agar tidak duplikat saat dijalankan ulang
        Customer::truncate();

        // Menambah data secara manual
        Customer::create([
            'name' => 'Daiva Admin',
            'contact' => '082110051917',
            'email' => 'daiva@deltanet.com',
        ]);

        Customer::create([
            'name' => 'Yusuf Starboy',
            'contact' => '08123456789',
            'email' => 'yusuf@deltanet.com',
        ]);
    }
}
