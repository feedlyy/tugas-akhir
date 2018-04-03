<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Staff;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{

    //

    public function importExcel(Request $request){
        if ($request->hasFile('file')){
            $excel = Excel::load(public_path('\excel\data_staff.xlsx'), function ($reader){
                $result = $reader->toObject();
                if (!empty($result) && $result->count()){
                    foreach ($result as $key => $value){
                        $staff = new Staff;
                        $staff->id_status = $value->id_status;
                        $staff->nip = $value->nip;
                        $staff->nama_staff = $value->nama_staff;
                        $staff->email = $value->email;
                        $staff->alamat = $value->alamat;
                        $staff->no_hp = $value->no_hp;
                        $staff->save();
                    }
                }
            })->get();
        }
        return redirect('admin/staff')->with(session()->flash('import', ''));

    }

}
