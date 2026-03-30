<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Belum login → ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // Role cocok → lanjutkan
        if ($userRole === $role) {
            return $next($request);
        }

        // Role tidak cocok → redirect ke dashboard sesuai role-nya
        if ($userRole === 'admin') {
            return redirect()->route('admin.dashboard')
                ->with('info', 'Anda dialihkan ke halaman admin.');
        }

        if ($userRole === 'customer') {
            return redirect()->route('dashboard')
                ->with('info', 'Anda dialihkan ke halaman klien.');
        }

        abort(403, 'Akses ditolak');
    }
}
            