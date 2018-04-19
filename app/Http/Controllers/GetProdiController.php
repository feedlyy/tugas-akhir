<?php

namespace App\Http\Controllers;

use App\Prodi;
use Illuminate\Http\Request;

class GetProdiController extends Controller
{
    //
    public function GetProdi($departemen = '')
    {
        $prodi = Prodi::query()
            ->select('id_prodi')
            ->where('id_departemen', $departemen)->get();
        return json_encode($prodi);
    }


}
