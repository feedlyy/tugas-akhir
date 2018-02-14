<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

//    method aslinya ini handle tanpa $user
    public function handle($request, Closure $next, $guard = null)
    {
        //ini auth kalau pake elseif harus ada return default nya
        if (Auth::guard($guard)->check()) {
//            if (Auth::user() == true && Auth::user()->id_status == 1)
//            {
//                return redirect()->route('fakultas');
//            }elseif (Auth::user() == true && Auth::user()->id_status == 2)
//            {
//                return redirect()->route('departemen');
//            }elseif (Auth::user() == true && Auth::user()->id_status == 3)
//            {
//                return redirect()->route('prodi');
//            }
            if (Auth::check() == true){
                return redirect()->route('tampilan');
            }
            return redirect('/login');
        }
        return $next($request);
    }
}
