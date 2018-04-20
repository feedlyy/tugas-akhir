<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Departemen;
use App\Rules\Lowercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddAdmin extends Controller
{
    //

    public function create()
    {
        $departemen = Departemen::all();
        return view('Admin.TambahAdminDepartemen')->with('departemen', $departemen);
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'username' => ['required', new Lowercase, 'unique:admins,username'],
            'password' => ['required'],
            'selectdepartemen' => ['required']
        ]);

        $admin = new Admin;
        $admin->username = $request->username;
        $admin->password = bcrypt($request->password);
        $admin->id_fakultas = Auth::user()->id_fakultas;
        $admin->id_departemen = $request->selectdepartemen;
        $admin->save();

        return redirect('admin/admin')->with(session()->flash('status', ''));


    }
}
