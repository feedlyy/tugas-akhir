<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Maatwebsite\Excel\Excel;

class ImportExcelController extends Controller
{
    //
    public function importExcel(Request $request){
        if ($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if (!empty($data) && $data->count()){
                foreach ($data as $key => $value){
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
        }
        return redirect('admin/staff')->with(session()->flash('import', ''));
    }
}
