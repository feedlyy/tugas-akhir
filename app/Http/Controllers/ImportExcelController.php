<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Staff;
use Illuminate\Support\Facades\App;



class ImportExcelController extends Controller
{

    //
    public function importExcel(Request $request){

        if ($request->hasFile('file')){
            $path = $request->file('file')->getRealPath();
            if (!empty($data) && $data->count()){
                foreach ($data as $key){
                    $staff = new Staff;
                    $staff->id_status = $key->id_status;
                    $staff->nip = $key->nip;
                    $staff->nama_staff = $key->nama_staff;
                    $staff->email = $key->email;
                    $staff->alamat = $key->alamat;
                    $staff->no_hp = $key->no_hp;
                    $staff->save();
                }
            }

        }
        return redirect('admin/staff')->with(session()->flash('import', ''));
    }
}
