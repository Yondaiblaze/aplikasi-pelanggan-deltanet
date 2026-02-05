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

    // Public Settings Routes (no auth needed)
    $router->get('/settings', 'SettingController@index');
    $router->get('/settings/theme', 'SettingController@getTheme');

    // 1. Kirim OTP (biasanya untuk login/lupa password)
    $router->post('/send-otp', 'AuthController@sendOtp');

    // 2. Login (Hapus 'api/' di depan, karena sudah ada di prefix group)
    $router->post('/login', 'AuthController@login');

    // 3. Verifikasi OTP
    $router->post('/verify-otp', 'AuthController@verifyOtp');

    // 4. Registrasi
    $router->post('/register', 'AuthController@register');

    // 5. Reset Password
    $router->post('/reset-password', 'AuthController@resetPassword');
    $router->post('/set-first-password', 'AuthController@setFirstPassword');


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
        $router->get('/commissions/benefits', 'CommissionController@benefits');
        $router->post('/commissions/withdraw', 'CommissionController@withdraw');
        
        // Route Referral
        $router->get('/referral/my-code', 'ReferralController@getMyReferralCode');
        $router->post('/referral/apply', 'ReferralController@applyReferralCode');
        $router->get('/referral/my-referrals', 'ReferralController@myReferrals');
        $router->post('/referral/invite-friend', 'ReferralController@inviteFriend');
        
        // Route Customer Dashboard
        $router->get('/customer/dashboard', 'CustomerController@index');
        $router->get('/customer/billing-status', 'CustomerController@getBillingStatus');
        $router->get('/customer/profile', 'CustomerController@getProfile');
        $router->put('/customer/profile', 'CustomerController@updateProfile');
        
        // Route Bank Account
        $router->get('/bank-accounts', 'BankAccountController@index');
        $router->get('/bank-accounts/primary', 'BankAccountController@getPrimary');
        $router->post('/bank-accounts', 'BankAccountController@store');
        $router->post('/bank-accounts/{id}/verify-otp', 'BankAccountController@verifyOtp');
        $router->put('/bank-accounts/{id}', 'BankAccountController@update');
        $router->delete('/bank-accounts/{id}', 'BankAccountController@destroy');
        
        // Route Session Management
        $router->get('/sessions', 'SessionController@index');
        $router->get('/sessions/current', 'SessionController@getCurrent');
        $router->delete('/sessions/{id}', 'SessionController@destroy');
        $router->post('/sessions/logout-others', 'SessionController@logoutOthers');
        $router->post('/sessions/logout-all', 'SessionController@logoutAll');
    });
});

    // Temanmu tinggal nambahin route-nya di bawah sini nanti:
    // $router->get('/commissions', 'CommissionController@index');
