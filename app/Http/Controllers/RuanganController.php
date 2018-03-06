<?php

namespace App\Http\Controllers;

use DB;
use App\Ruangan;
use App\Gedung;
use App\Rules\CombineColumn;
use App\Rules\Kapital;
use App\Rules\Uppercase;
/*use Illuminate\Contracts\Validation\Rule;*/

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
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
        $gedung = Ruangan::all();
        return view('Admin.TambahRuangan')
            ->with('gedung', $gedung)
            ->with('ruangan', $ruangan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $users = Ruangan::select('id_ruangan', 'id_gedung')
            ->where('id_ruangan', $request->id_ruangan)
            ->where('id_gedung', $request->selectgedung)->get();
        if (count($users) > 0) {
            return redirect('admin/ruangan/create')->with(session()->flash('alert_data_is_exist', ''));
        } else {
            /*$id = Ruangan::all('nama_ruangan');*/
            /*bikin validasi*/
            $validasi = $request->validate([
                'id_ruangan' => ['required', 'max:255', new Kapital]/*,
                'nama_ruangan' => ['unique:ruangans,nama_ruangan']*/
            ]);

            /*$collection = collect([$ruangan->id_gedung, $ruangan->id_ruangan]);
            $combined = $collection->combine([$request->selectgedung, $request->id_ruangan]);
            $combined->all();*/
            $ruangan = new Ruangan;
            $ruangan->id_ruangan = $request->id_ruangan;
            $ruangan->id_gedung = $request->selectgedung;
            $ruangan->nama_ruangan = $request->selectgedung.' - '.$request->id_ruangan;

            /*$ruangan->nama_ruangan = $request->input('', $request->id_ruangan);*/
            /*kalau mau ambil semua inputan jadi satu array pake request all*/
            /*$ruangan = $request->all();*/

            $ruangan->save();

            $request->session()->flash('status', 'Data Berhasil Di Input');

            return redirect('admin/ruangan');
        }


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
                'ruangan' => ['required', 'max:255', new Kapital]
            ]);

            $ruangan = Ruangan::find($id);
            $ruangan->id_ruangan = $request->ruangan;
            /*$ruangan->nama_ruangan = $request->nama_ruangan;*/
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
        $ruangan = Ruangan::find($id);
        $ruangan->delete();

        return redirect('admin/ruangan')->with(session()->flash('hapus', 'Data Berhasil Di Hapus'));
    }
}
