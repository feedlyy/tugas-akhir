<?php

namespace App\Http\Controllers;

use App\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departemen = Departemen::all();
        return view('Admin.Departemen')
            ->with('departemen', $departemen);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.TambahDepartemen');
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
           'id_departemen' => ['required'],
           'nama_departemen' => ['required']
        ]);

        $departemen = new Departemen;
        $departemen->id_departemen = strtolower($request->id_departemen); /*simpan dengan huruf kecil semua*/
        $departemen->nama_departemen = ucwords($request->nama_departemen); /*simpan dengan huruf kapital di awalnya*/
        $departemen->id_fakultas = Auth::user()->id_fakultas;
        $departemen->save();

        return redirect('admin/departemen')->with(session()->flash('status', ''));
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
        $departemen = Departemen::find($id);
        $departemen->delete();

        return redirect('admin/departemen')->with(session()->flash('hapus', ''));
    }
}
