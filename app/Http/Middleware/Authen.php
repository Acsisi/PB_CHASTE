<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika butuh variable tambahan, letakkan variable setelah $next pisahkan dengan koma
        // Bisa lebih dari satu

        // Cek apakah user tidak pernah login atau role user tidak sesuai
        if (!session()->has('middleware') || $role != session()->get('middleware')){
            return redirect('login'); // jika iya maka akan dilempar ke login dan request tidak diteruskan
        }

        // jika tidak maka request akan diteruskan
        return $next($request);
    }
}
