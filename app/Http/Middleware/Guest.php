<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user pernah login
        if(session()->has('middleware')){
            // Jika iya kembalikan sesuai posisi semula
            if (session()->get('middleware') == "user"){
                return redirect('user');
            }
            else if(session()->get('middleware') == "tenant"){
                return redirect('hlmnTenant');
            }
            else if(session()->get('middleware') == "admin"){
                return redirect('dashboard');
            }
        }

        // Jika tidak lanjutkan request
        return $next($request);
    }
}
