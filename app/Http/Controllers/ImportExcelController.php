<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Staff;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{

    //

    public function importExcel(Request $request){
        if ($request->hasFile('file') != 'data_staff.xlsx'){
            return redirect('admin/staff')->with(session()->flash('gagal', ''));
        } else {
            if ($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                $excel = Excel::load($path, function ($reader){
                    $result = $reader->toObject();
                    if (!empty($result) && $result->count()){
                        foreach ($result as $key => $value){
                            $cek = Staff::query()
                                ->where('nip', '=', $value->nip)
                                ->where('nama_staff', '=', $value->nama_staff)
                                ->get();
                            $hitung = count($cek);
                            if ($hitung == 0) {
                                $staff = new Staff;
                                $staff->id_fakultas = $value->id_fakultas;
                                $staff->id_departemen = $value->id_departemen;
                                $staff->id_prodi = $value->id_prodi;
                                $staff->nip = $value->nip;
                                $staff->nama_staff = $value->nama_staff;
                                $staff->email = $value->email;
                                $staff->alamat = $value->alamat;
                                $staff->no_hp = $value->no_hp;
                                $staff->save();
                            }
                        }
                    }
                })->get();
            }
        }


        return redirect('admin/staff')->with(session()->flash('import', ''));
    }

}
