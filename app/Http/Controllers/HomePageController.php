<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //
    public function jadwal()
    {
        return view('jadwal');
    }
    public function visi()
    {
        return view('visi_misi');
    }
}
