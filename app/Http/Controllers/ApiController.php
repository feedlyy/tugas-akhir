<?php

namespace App\Http\Controllers;

use App\Http\Resources\StafResource;
use App\Staff;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function index($id)
    {
        $staf = Staff::query()->find($id);
        $staf->nama_staff = 'test update ya mbak hedon';
        /*kita tes ya, data staf yang ke-15 sebelumnya itu namanya 0
        kita ambil tes di bagian staf data ke-15
        nanti kalau aku jalanin namanya berubah jadi 'test update ya mbak hedon'*/
        $staf->save();
        return new StafResource($staf);
    }
}
