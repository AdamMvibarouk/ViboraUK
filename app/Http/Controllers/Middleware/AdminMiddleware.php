<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $isAdmin = DB::table('user_roles')
            ->join('roles', 'user_roles.role_id', '=', 'roles.role_id')
            ->where('user_roles.user_id', Auth::user()->user_id)
            ->where('roles.role_name', 'admin')
            ->exists();

        if (!$isAdmin) {
            abort(403, 'Admin access only.');
        }

        return $next($request);
    }
}