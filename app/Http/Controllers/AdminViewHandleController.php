<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminViewHandleController extends Controller
{
    //
//    public function vokasi()
//    {
//        return view('home');
//    }

    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

//    public function tes()
//    {
//        return view('hometes');
//    }
//    public function vokasi()
//    {
//        return view('Admin.dashboardAdminVokasi');
//    }
//    public function tedi()
//    {
//        return view('Admin.dashboardAdminTedi');
//    }
//    public function kalendar()
//    {
//        return view('Admin.kalender');
//    }
    public function tampilan()
    {
        return view('Admin.templateAdmin');
    }

    public function fakultas()
    {
        return view('Admin.AdminFakultas');
    }

    public function departemen()
    {
        return view('Admin.AdminDepartemen');
    }

    public function prodi()
    {
        return view('Admin.AdminProdi');
    }
}
