<?php

namespace App\Http\Controllers;

use App\Rules\Uppercase;
use App\Staff;
use App\Status;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $staff = Staff::all();
        return view('Admin.Staff')->with('staff', $staff);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $staff = Staff::all();
        return view('Admin.TambahStaff')
            ->with('staff', $staff);
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
            'nip' => ['required', 'unique:stafs,nip', 'integer'],
            'nama_staff' => ['required', 'string', new Uppercase],
            'email_staff' => ['required', 'email'],
            'alamat' => ['required'],
            'hp' => ['required', 'numeric', 'digits_between:10,13'],
        ]);

        $staff = new Staff;
        $staff->nip = $request->nip;
        $staff->nama_staff = $request->nama_staff;
        $staff->email = $request->email_staff;
        $staff->alamat = $request->alamat;
        $staff->no_hp = $request->hp;

        $staff->save();
        return redirect('admin/staff')->with(session()->flash('status', ''));
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
        $staff = Staff::find($id);
        return view('Admin.ShowStaff')->with('staff', $staff);
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
        $staff = Staff::find($id);
        return view('Admin.EditStaff')->with('staff', $staff);
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
            'nama_staff' => ['required', 'string', new Uppercase],
            'email_staff' => ['required', 'email'],
            'alamat' => ['required'],
            'hp' => ['required', 'numeric', 'digits_between:10,13']
        ]);

        $staff = Staff::find($id);
        $staff->nama_staff = $request->nama_staff;
        $staff->email = $request->email_staff;
        $staff->alamat = $request->alamat;
        $staff->no_hp = $request->hp;
        $staff->save();

        return redirect('admin/staff')->with(session()->flash('update', ''));
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
        $staff = Staff::find($id);
        $staff->delete();

        return redirect('admin/staff')->with(session()->flash('hapus', ''));
    }
}
