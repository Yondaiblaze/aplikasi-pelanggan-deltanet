<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set('Asia/Jakarta');

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

// Aktifkan Facades dan Eloquent agar DB & JWT bisa jalan
$app->withFacades();
$app->withEloquent();

// Buat Alias untuk JWTAuth (Opsional, tapi mempermudah pemanggilan di Controller)
if (!class_exists('JWTAuth')) {
    class_alias(Tymon\JWTAuth\Facades\JWTAuth::class, 'JWTAuth');
}

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
*/

// Daftarkan config auth agar Lumen tahu cara login-nya pake JWT
$app->configure('auth');
$app->configure('jwt'); // Penting untuk konfigurasi token (expire, secret key)

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
*/

// Daftarkan Service Provider JWT
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);

// Daftarkan AuthServiceProvider bawaan
$app->register(App\Providers\AuthServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/

$app->routeMiddleware([
    'auth'     => App\Http\Middleware\Authenticate::class,
    'auth.jwt' => App\Http\Middleware\JwtMiddleware::class, // Satpam pengecek token
]);

// Tambahkan Middleware Global (CORS agar Frontend bisa akses API tanpa error)
$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
]);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
