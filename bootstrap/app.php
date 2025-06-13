<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\AdminMiddleware; // <-- Tambahkan baris ini!

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan alias middleware Anda di sini
        $middleware->alias([
            'admin' => AdminMiddleware::class, // <-- Tambahkan baris ini!
        ]);

        // Jika Anda ingin menambahkan middleware ke grup 'web' secara default, Anda bisa tambahkan di sini:
        // $middleware->web(append: [
        //     // \App\Http\Middleware\TrustProxies::class, // Ini contoh bawaan Laravel
        //     // ... middleware lain untuk setiap request web
        // ]);
    
        // Jika Anda memiliki middleware untuk API
        // $middleware->api(prepend: [
        //     // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();