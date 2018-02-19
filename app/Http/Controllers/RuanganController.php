<?php

namespace App\Http\Controllers;

use App\Ruangan;
use App\Gedung;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\View\View;


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
        return view('Admin.Ruangan')
            ->with('ruangan', $ruangan)
            ->with('gedung', $gedung);
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
        return view('Admin.TambahRuangan')->with('ruangan', $ruangan);
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
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $ruangan = Ruangan::find($id);
        $gedungs = Gedung::all();
        return View('Admin.EditRuangan')
            ->with('ruangan', $ruangan)
            ->with('gedung', $gedungs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
//        bikin validasi
            $validasi = $request->validate([
                'ruangan' => ['required', 'max:255', new Uppercase]
            ]);

            $ruangan = Ruangan::find($id);
            $ruangan->nama_ruangan = $request->ruangan;
//            $ruangan->id_gedung = $request->selectgedung;

            $ruangan->save();

            $request->session()->flash('update', 'Data Berhasil Di Update');

            return redirect('admin/ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
