<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MahasiswaAuth
{
    /**
     * Ensure the user (mahasiswa) has an active session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('mahasiswa_id')) {
            return redirect()->route('loginuser')->withErrors([
                'nim' => 'Silakan login terlebih dahulu.',
            ]);
        }

        return $next($request);
    }
}
