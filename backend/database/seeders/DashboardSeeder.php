<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Ticket;
use App\Models\Customer;

class DashboardSeeder extends Seeder
{
    public function run()
{
    $customer = Customer::first();

    if ($customer) {
        // 1. Bagian Invoice (Sudah aman dari error sebelumnya)
        $invoice = Invoice::create([
            'invoice_id'       => 10001,
            'user_id'          => $customer->id,
            'customer_id'      => $customer->id,
            'account_type'     => 'Accounting',
            'category_id'      => 1,
            'issue_date'       => '2024-04-01',
            'due_date'         => '2024-04-10',
            'account_id'       => 1,
            'status'           => 0,
            'shipping_display' => 1,
            'invoice_module'   => 'invoice',
            'created_by'       => 1
        ]);

        // 2. Bagian Invoice Product (Perbaikan Error 'product_id')
        InvoiceProduct::create([
            'invoice_id'   => $invoice->id,
            'product_id'   => 1,                 // Tambahkan ini (kolom wajib)
            'product_name' => 'Premium 50 Mbps',
            'product_type' => 'Internet',
            'quantity'     => 1,
            'price'        => 400000,
            'tax'          => '0',               // Tambahkan ini (kolom wajib)
            'discount'     => 0,                 // Tambahkan ini (kolom wajib)
            'description'  => 'Langganan Bulanan'
        ]);
    }
}
}
