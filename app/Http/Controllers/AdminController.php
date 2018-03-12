<?php

namespace App\Http\Controllers;

use App\Rules\Lowercase;
use Illuminate\Http\Request;
use App\Admin;
use App\Status;
use App\Rules\Kapital;
use App\Rules\Uppercase;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Admin::all();
        return view('Admin.Admin')->with('admin', $admin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $status = Status::all();
        return view('Admin.TambahAdmin')->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validasi = $request->validate([
           /*'id_admin' => ['required', new Lowercase, 'unique:admins'],*/
            'nama_admin' => ['required', new Lowercase, 'unique:admins,nama_admin'],
            'password' => ['required'],
            'selectstatus' => ['required']
        ]);

        $admin = new Admin;
        /*penjelasan $admin->id_admin(ini yang ada di kolom table)
        sedangkan $request->id_admin(ini name yang ada di input view nya)
        kebetulan dibikin sama name nya*/
        /*$admin->id_admin = $request->id_admin;*/
        $admin->nama_admin = $request->nama_admin;
        $admin->password = bcrypt($request->password);
        $admin->id_status = $request->selectstatus;

        $admin->save();
        return redirect('admin/admin')->with(session()->flash('status', ''));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin =  Admin::find($id);
        return view('Admin.AdminEdit')->with('admin', $admin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validasi = $request->validate([
            'password_baru' => ['required', 'same:konfirm_password'],
            'konfirm_password' => ['required', 'same:password_baru']
        ]);

        $admin = Admin::find($id);

        $admin->password = bcrypt($request->konfirm_password);
        $admin->save();

        return redirect('admin/admin')->with(session()->flash('update', ''));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Admin::find($id);
        $admin->delete();

        return redirect('admin/admin')->with(session()->flash('hapus', ''));
    }
}
