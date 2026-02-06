<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

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

// Buat Alias untuk JWTAuth agar bisa dipanggil langsung sebagai 'JWTAuth'
class_alias(Tymon\JWTAuth\Facades\JWTAuth::class, 'JWTAuth');

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

// Daftarkan config sebelum Service Provider agar driver 'jwt' terbaca
$app->configure('app');
$app->configure('auth');

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
*/

// Daftarkan Service Provider JWT
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);

// Daftarkan AuthServiceProvider bawaan (Sangat Penting untuk Guard 'api')
$app->register(App\Providers\AuthServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/

$app->routeMiddleware([
    'auth'     => App\Http\Middleware\Authenticate::class,
    'auth.jwt' => App\Http\Middleware\JwtMiddleware::class, // Satpam buatanmu
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
