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
    return $router->app->version();

}
);

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/send-otp', 'AuthController@sendOtp');
    $router->post('/login', 'AuthController@login');
});

$router->post('/api/register', 'AuthController@register');

// Route API yang butuh login (Token JWT)
$router->group(['middleware' => 'auth.jwt', 'prefix' => 'api'], function () use ($router) {

    // Contoh Route untuk temanmu
    $router->get('/invoices', 'InvoiceController@index');

    // Temanmu tinggal nambahin route-nya di bawah sini nanti:
    // $router->get('/commissions', 'CommissionController@index');
});
