<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return response()->json([
        'app' => 'DeltaNet Customer API',
        'version' => $router->app->version(),
        'status' => 'running'
    ]);
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/send-otp', 'AuthController@sendOtp');
    $router->post('/login', 'AuthController@login');
    
    // Test konten tanpa auth (untuk development)
    $router->get('/test-dashboard', function() {
        $customer = \App\Models\Customer::first();
        if (!$customer) {
            return response()->json(['error' => 'Tidak ada customer di database']);
        }
        
        // Cek kolom yang ada di tabel invoices
        $totalTagihan = \App\Models\Invoice::where('customer_id', $customer->id)->count();
        $tagihanBelumBayar = \App\Models\Invoice::where('customer_id', $customer->id)->where('status', 0)->count();
        
        return response()->json([
            'user' => ['name' => $customer->name, 'contact' => $customer->contact],
            'tagihan' => ['total' => $totalTagihan, 'belum_bayar' => $tagihanBelumBayar],
            'komisi' => ['total' => 0] // Sementara 0 karena struktur tabel belum jelas
        ]);
    });
    
    $router->get('/test-invoices', function() {
        $invoices = \App\Models\Invoice::limit(10)->get();
        return response()->json($invoices);
    });
    
    $router->get('/test-tickets', function() {
        $tickets = \App\Models\HelpdeskTicket::limit(10)->get();
        return response()->json($tickets);
    });
    
    $router->get('/test-commissions', function() {
        // Tampilkan semua data commissions untuk cek struktur tabel
        $commissions = \App\Models\Commission::limit(5)->get();
        return response()->json($commissions);
    });
});

// Route API yang butuh login (Token JWT)
$router->group(['middleware' => 'auth.jwt', 'prefix' => 'api'], function () use ($router) {

    // Dashboard
    $router->get('/dashboard', 'DashboardController@index');
    
    // Tagihan
    $router->get('/invoices', 'InvoiceController@index');
    $router->get('/invoices/{id}', 'InvoiceController@show');
    $router->post('/invoices/{id}/pay', 'InvoiceController@pay');
    
    // Tiket Bantuan
    $router->get('/tickets', 'TicketController@index');
    $router->post('/tickets', 'TicketController@store');
    $router->get('/tickets/{id}', 'TicketController@show');
    $router->put('/tickets/{id}', 'TicketController@update');
    
    // Referral
    $router->get('/referral', 'ReferralController@index');
    $router->get('/referral/friends', 'ReferralController@friends');
    
    // Komisi
    $router->get('/commissions', 'CommissionController@index');
    $router->post('/commissions/withdraw', 'CommissionController@withdraw');
});
