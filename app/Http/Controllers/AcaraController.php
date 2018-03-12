<?php

namespace App\Http\Controllers;

use App\Acara;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use App\Ruangan;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $acara = Acara::all();

        return view('Admin.Acara')->with('acara', $acara);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $ruangan = Ruangan::all();
        return view('Admin.TambahAcara')->with('ruangan', $ruangan);
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
        /*$contoh = Carbon::parse($request->tanggal_acara);*/

        /*berarti logikanya di store ini ada 2 kali fungsi
        pertama fungsi store ke db
        kedua create event ke googlecalendar nya*/

        $validasi = $request->validate([
            'nama_acara' => ['required', new Uppercase],
            'tamu_undangan' => ['required', 'email'],
            'nama_ruang' => ['required']
        ]);

        /*ini store ke db*/
        $acara = New Acara;
        $acara->nama_event = $request->nama_acara;
        $acara->detail_acara = Carbon::parse($request->detail_acara)->toDateTimeString();
        $acara->alarm = Carbon::now();
        $acara->nama_ruangan = $request->nama_ruang;
        $acara->tamu_undangan = $request->tamu_undangan;
        $acara->id_admin = 1;

        $acara->save();
        return redirect('admin/acara')->with(session()->flash('status', ''));


        /*ini store ke gCalendar*/
        $google = New Event;

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
        $acara = Acara::find($id);
        $acara->delete();

        return redirect('admin/acara')->with(session()->flash('hapus', ''));
    }
}
