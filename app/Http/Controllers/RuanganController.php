<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Gedung;
use App\Rules\Uppercase;
use Illuminate\Http\Request;


class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ruangan = Ruangan::all();
        $gedung = Gedung::all();
        return view('Admin.Ruangan', compact('ruangan', 'gedung'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        /*ini make model nya gedung karena buat get seluruh id yang ada di gedung*/
        $ruangan = Gedung::all();
        return view('Admin.TambahRuangan', compact('ruangan'));
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
//        bikin validasi
            $validasi = $request->validate([
               'ruangan' => ['required', 'max:255', new Uppercase]
            ]);

        $ruangan = new Ruangan;
        $ruangan->nama_ruangan = $request->ruangan;
        $ruangan->id_gedung = $request->selectgedung;
        $ruangan->save();

        $request->session()->flash('status', 'Data Berhasil Di Input');

        return redirect('admin/ruangan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        //
    }
}
