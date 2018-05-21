<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;
use App\Ruangan;
use function MongoDB\BSON\toJSON;

class GetNamaController extends Controller
{
    //
    public function getNamaRuang($id_gedung = '')
    {
        csrf_field();
        $ruangan = Ruangan::query()->select('id_ruangan', 'nama_ruangan')
            ->where('id_gedung', $id_gedung)->get();
        return $ruangan->toJson();
    }

    /*public function getDepartemen($fakultas)
    {
        $departemen = Staff::query()
            ->select('id_departemen', 'email')
            ->where('id_fakultas', $fakultas)->get();
        return json_encode($departemen);
    }*/

    /*get fakultas*/
    public function getSummary($fakultas = ''){
        $getfakultas = Staff::query()->select('id_staff', 'email')
            ->where('id_fakultas', $fakultas)
            ->where('id_departemen', null)
            ->where('id_prodi', null)
            ->get();
        return json_encode($getfakultas);
    }

    /*get departemen*/
    public function getSummary2($departemen){
            $arrDepartemen = explode(',', $departemen);
            $getDepartemen = Staff::query()->select('id_staff', 'email')
                ->whereIn('id_departemen', $arrDepartemen)
                ->where('id_prodi', null)
                ->get();
            return json_encode($getDepartemen);
    }

    /*get prodi*/
    public function getSummary3($prodi){
        $arrProdi = explode(',', $prodi);
        $getProdi = Staff::query()->select('id_staff', 'email')
            ->whereIn('id_prodi', $arrProdi)
            ->get();
        return json_encode($getProdi);
    }

}
