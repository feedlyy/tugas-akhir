<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ruangan;

class GetNamaController extends Controller
{
    //
    public function getNamaRuang($id_gedung = '')
    {
        $ruangan = Ruangan::select('id_ruangan', 'nama_ruangan')
            ->where('id_gedung', $id_gedung)->get();
        return json_encode($ruangan);
    }
}
