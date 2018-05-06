<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\Rules\Kapital;
use App\Rules\Uppercase;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Foundation\Validation\ValidatesRequests;

class GedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gedung = Gedung::all();
        return view('Admin.Gedung')->with('gedung', $gedung);


    }

//    public function index2()
//    {
//        return view('Admin.Gedung');
//    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.TambahGedung');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //bikin validasi nya
        $validasi = $request->validate([
            'gedung' => ['required', 'unique:gedungs,nama_gedung','max:255', new Uppercase],
            'id_gedung' => ['required', 'unique:gedungs', 'max:255', new Kapital]
            /*uppercase itu fungsi validasi custom dimana setiap inputan kalimat dari gedung
            harus diawali dengan huruf kapital*/

            /*unique itu sebenernya hanya untuk validasi biar data di database ga boleh dobel untuk primary
            key, tapi bisa di custom dengan cara: unique:(nama tabel),(nama kolom)*/
        ]);

        //ini store data ke db gedungs nya
        $gedung = new Gedung;
        $gedung->id_gedung = $request->id_gedung;
        $gedung->nama_gedung = $request->gedung;
        $gedung->created_by = Auth::user()->username;
        $gedung->save();
        $request->session()->flash('status', 'Data Berhasil Di Input');

        return redirect('admin/gedung');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

    /**
     * Display the specified resource.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function show(Gedung $gedung)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $gedung = Gedung::find($id);

        return view('Admin.EditGedung')->with('gedung', $gedung);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validasi = $request->validate([
            'gedung' => ['required', 'unique:gedungs,nama_gedung','max:255', new Uppercase],
            'id_gedung' => ['required', 'max:255', new Kapital]
            /*uppercase itu fungsi validasi custom dimana setiap inputan kalimat dari gedung
            harus diawali dengan huruf kapital*/
        ]);

        $gedung = Gedung::find($id);
        $gedung->id_gedung = $request->id_gedung;
        $gedung->nama_gedung = $request->gedung;
        $gedung->created_by = Auth::user()->username;
        $gedung->save();
        $request->session()->flash('update', 'Data Berhasil Di Update');

        return redirect('admin/gedung');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $gedung = Gedung::find($id);
        $gedung->delete();

        return redirect('admin/gedung')->with(session()->flash('hapus', 'Data Berhasil Di Hapus'));

    }
}
