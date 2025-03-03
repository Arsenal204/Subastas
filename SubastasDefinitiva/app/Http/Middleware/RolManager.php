<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RolManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rol): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authUserRol = Auth::user()->rol;

        switch ($rol) {
            case 'admin':
                if ($authUserRol == '0') {
                    return $next($request);
                }
                break;
            case 'vendedor':
                if ($authUserRol == '1') {
                    return $next($request);
                }
                break;
            case 'user':
                if ($authUserRol == '2') {
                    return $next($request);
                }
                break;    
        }

        switch ($authUserRol) {
            case '0':
                return redirect()->route('admin');
                break;
            case '1':
                return redirect()->route('vendedor');
                break;
            case '2':
                return redirect()->route('dashboard');
                break;
        }

        return redirect()->route('login');
    }
}
