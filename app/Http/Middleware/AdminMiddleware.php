<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User; // Penting: Impor Model User
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Tangani permintaan masuk.
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('AdminMiddleware: Checking access for request URL: ' . $request->fullUrl());

        if (!Auth::check()) {
            Log::info('AdminMiddleware: User not authenticated. Redirecting to login.');
            return redirect('/login');
        }

        $user = Auth::user();
        Log::info('AdminMiddleware: User authenticated. Email: ' . $user->email . ' | Role: ' . $user->role);

        if ($user->role === User::ROLE_ADMIN || $user->role === User::ROLE_SUPER_ADMIN) {
            Log::info('AdminMiddleware: User has ADMIN or SUPER_ADMIN role. Access granted.');
            return $next($request);
        } else {
            Log::warning('AdminMiddleware: User does NOT have ADMIN or SUPER_ADMIN role. Role found: ' . $user->role . '. Access denied.');
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
}