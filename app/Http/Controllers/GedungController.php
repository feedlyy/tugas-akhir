<?php

namespace App\Http\Controllers;

use App\Gedung;
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
        return view('Admin.Gedung', compact('gedung'));


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
            'gedung' => ['required', 'max:255', new Uppercase]
            /*uppercase itu fungsi validasi custom dimana setiap inputan kalimat dari gedung
            harus diawali dengan huruf kapital*/
        ]);



        //ini store data ke db gedungs nya
        $gedung = new Gedung;

        $gedung->nama_gedung = $request->gedung;

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function edit(Gedung $gedung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gedung $gedung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gedung  $gedung
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gedung $gedung)
    {
        //

    }
}
