<?php
/** @var \Laravel\Lumen\Routing\Router $router */


// ... kode route kamu di bawahnya ...

$router->get('/', function () use ($router) {
    return $router->app->version();

}
);
// Router tentang per login login an
// Router Autentikasi & OTP (Satu Pintu)
$router->group(['prefix' => 'api'], function () use ($router) {

    // 1. Kirim OTP (biasanya untuk login/lupa password)
    $router->post('/send-otp', 'OtpController@sendOtp');

    // 2. Login (Hapus 'api/' di depan, karena sudah ada di prefix group)
    $router->post('/login', 'AuthController@login');

    // 3. Verifikasi OTP
    $router->post('/verify-otp', 'AuthController@verifyOtp');

    // 4. Registrasi
    $router->post('/register', 'AuthController@register');

    // 5. Forgot Password (Generate OTP)
    $router->post('/forgot-password', 'AuthController@forgotPasswordAPI');

    // 6. Resend OTP
    $router->post('/resend-otp', 'OtpController@sendOtp');

    // 7. Reset Password
    $router->post('/reset-password', 'AuthController@resetPassword');


// --- PROTECTED ROUTES (HARUS LOGIN / PAKAI TOKEN JWT) ---
    $router->group(['middleware' => 'auth'], function () use ($router) {

        // Profile & Auth Action
        $router->get('/me', 'AuthController@me');
        $router->post('/logout', 'AuthController@logout');

        // Fitur Referral (Update kode teman dari Dashboard)
        $router->post('/update-referral', 'AuthController@updateReferral');

        // Fitur Invoice / Tagihan
        $router->get('/invoices', 'InvoiceController@index');
        $router->get('/invoices/{id}', 'InvoiceController@show');
        $router->post('/invoices/{id}/pay', 'InvoiceController@pay');

        // Fitur Ticket / Pengaduan
        $router->get('/tickets', 'TicketController@index');
        $router->post('/tickets', 'TicketController@store');

        // Fitur Komisi
        $router->get('/commissions', 'CommissionController@index');
        $router->post('/commissions/withdraw', 'CommissionController@withdraw');
    });
});

    // Temanmu tinggal nambahin route-nya di bawah sini nanti:
    // $router->get('/commissions', 'CommissionController@index');

