<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prodi = Prodi::all();
        return view('Admin.Prodi')
            ->with('prodi', $prodi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departemen = Departemen::all();
        return view('Admin.TambahProdi')
            ->with('departemen', $departemen);
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
        /*jika yg login fakultas butuh validasi select*/
        if (\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
            \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
            \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
        {
            $validasi = $request->validate([
                'id_prodi' => ['required', 'unique:prodis'],
                'nama_prodi' => ['required', 'unique:prodis,nama_prodi'],
                'selectdepartemen' => ['required']
            ]);
        } else { /*jika bukan fakultas maka tidak diperlukan validasi select*/
            $validasi = $request->validate([
                'id_prodi' => ['required', 'unique:prodis'],
                'nama_prodi' => ['required', 'unique:prodis,nama_prodi']
            ]);
        }


        $prodi = new Prodi;
        /*store id fakultas berdasarkan id fakultas admin yang masuk sekarang*/
        $prodi->id_fakultas = Auth::user()->id_fakultas;
        $prodi->id_prodi = strtolower($request->id_prodi);
        $prodi->nama_prodi = ucwords($request->nama_prodi);
        /*jika yang melakukan store itu fakultas*/
        if (\Illuminate\Support\Facades\Auth::user()->id_fakultas != null &&
            \Illuminate\Support\Facades\Auth::user()->id_departemen == null &&
            \Illuminate\Support\Facades\Auth::user()->id_prodi == null)
        {
            /*maka store id departemen berdasarkan select*/
            $prodi->id_departemen = $request->selectdepartemen;
        } else {
            /*maka store id departemen berdasarkan id departemen admin yang masuk*/
            $prodi->id_departemen = Auth::user()->id_departemen;
        }
        $prodi->save();

        return redirect('admin/prodi')->with(session()->flash('status', ''));
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
        $prodi = Prodi::query()->find($id);
        $departemen = Prodi::query()
            ->select('id_departemen')
            ->where('id_prodi', $id)
            ->get();



        $tampung = ['dbsmb', 'deb', 'dtb', 'dtm', 'likes', 'sipil', 'tedi', 'thv'];

        /*dd($tampung);*/

        return view('Admin.EditProdi')
            ->with('tampung', $tampung)
            ->with('departemen', $departemen)
            ->with('prodi', $prodi);
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
        $prodi = Prodi::find($id);
        $prodi->delete();

        return redirect('admin/prodi')->with(session()->flash('hapus', ''));
    }
}
