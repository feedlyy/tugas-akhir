<?php

namespace App\Http\Controllers;


use App\Departemen;
use App\Fakultas;
use App\Prodi;
use Illuminate\Http\Request;
use App\Staff;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{

    //

    public function importExcel(Request $request){
            if ($request->hasFile('file')){
                $path = $request->file('file')->getRealPath();
                $excel = Excel::load($path, function ($reader){
                    $result = $reader->toObject();
                    if (!empty($result) && $result->count()){
                        foreach ($result as $key => $value){
                            try{
                                $cek = Staff::query()
                                ->where('nip', '=', $value->nip)
                                ->where('nama_staff', '=', $value->nama_staff)
                                ->get();

                                /*$cek2 = Prodi::query()
                                    ->join('departemens', 'departemens.id_departemen', '=', 'prodis.id_departemen')
                                    ->join('fakultas', 'departemens.id_fakultas', '=', 'fakultas.id_fakultas')
                                    ->where('prodis.id_fakultas', $value->id_fakultas)
                                    ->where('prodis.id_departemen', $value->id_departemen)
                                    ->where('prodis.id_prodi', $value->id_prodi)
                                    ->get();

                                $cek3 = Departemen::query()
                                    ->join('fakultas', 'departemens.id_fakultas', '=', 'fakultas.id_fakultas')
                                    ->where('fakultas.id_fakultas', $value->id_fakultas)
                                    ->get();*/

                                $cek2 = Prodi::query()
                                    ->where('id_prodi', '=', $value->id_prodi)
                                    ->where('id_fakultas', '=', $value->id_fakultas)
                                    ->where('id_departemen', '=', $value->id_departemen)
                                    ->get();
                                /*dd($cek2);*/

                                $hitung = count($cek);
                                if ($hitung == 0 && count($cek2) > 0 ) {
                                    if ($value->id_fakultas != null){
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

                                }}
                            catch (\Exception $e)
                            {

                            }
                        }
                    }
                })->get();
            }
        return redirect('admin/staff');
    }

    public function export()
    {
        $export = Staff::query()
            ->select('id_fakultas', 'id_departemen', 'id_prodi', 'nip',
                'nama_staff', 'email', 'alamat', 'no_hp')
            ->get();
        return Excel::create('data_staff', function ($excel) use ($export){
            $excel->sheet('Sheet1', function ($sheet) use ($export){
                $sheet->fromArray($export);
                // Set bold text on row 1
                $sheet->row(1, function($row) {

                    // call row manipulation methods
                    $row->setFont([
                       'bold' => 'true'
                    ]);

                });
            });
        })->export('xlsx');
    }

}
