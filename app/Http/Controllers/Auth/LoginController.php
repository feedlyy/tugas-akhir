<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminViewHandleController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function username()
    {
        return 'username';
    }

    protected $redirectTo = '/admin';

//    public function authenticated(Request $request, $user)
//    {
//
//        if (Auth::user() == true && Auth::user()->id_status == 1)
//        {
//            return redirect()->route('fakultas');
//        }elseif (Auth::user() == true && Auth::user()->id_status == 2)
//        {
//            return redirect()->route('departemen');
//        }elseif (Auth::user() == true && Auth::user()->id_status == 3)
//        {
//            return redirect()->route('prodi');
//        }
//        return redirect('/login');
//    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
