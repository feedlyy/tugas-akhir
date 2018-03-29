<?php

namespace App\Http\Controllers;

use App\Acara;
use App\Admin;
use App\Rules\Uppercase;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use App\Ruangan;
use App\Gedung;
use App\Tamu;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acara = Acara::all();
        $query = Acara::query()
            ->join('admins', 'acaras.penanggung_jawab', '=', 'admins.id_admin')
            ->where('acaras.penanggung_jawab', Auth::user()->id_admin)
            ->orWhere('admins.parent_id', Auth::user()->id_admin)
            ->get();
        $query2 = Acara::query()
            ->where('penanggung_jawab', '=', Auth::user()->id_admin)
            ->get();

        $masuk = [];


        return view('Admin.Acara')
            ->with('acara', $acara)
            ->with('query2', $query2)
            ->with('query', $query);


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
        $gedung = Gedung::all();
        return view('Admin.TambahAcara')
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
        //

        /*jadi kan inputan date itu kayak gini, contoh
        03/17/2018 12:00 AM - 03/17/2018 11:59 PM
        nah sedangkan nanti input nya itu di pisah, start date sama end date
        jadi pake laravel string helper buat ambil valuenya masing2*/
        $start = Carbon::parse(str_before($request->start_date, ' -'), 'Asia/Jakarta');
        $end = Carbon::parse(str_after($request->start_date, '- '), 'Asia/Jakarta');

        /*ini adalah validasi untuk diantara, jadi ini untuk validasi tanggal dan waktu nya
        biar tidak bentrok, menggunakan fungsi dari carbon yaitu between()*/
        $pengecekan = Acara::query()
            ->where('nama_ruangan', '=', $request->nama_ruang)
            ->where(function ($query) use ($start, $end){
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhereRaw('start_date < ? AND end_date > ?', [$start, $start])
                    ->orWhereRaw('start_date < ? AND end_date > ?', [$end, $end]);
            })
            ->get();
        $cek = count($pengecekan);

        $galat = [];

        if ($start < Carbon::today()){
            $galat = array_add($galat, '1', 'error1');
        } elseif($cek > 0) {
            $galat = array_add($galat, '2', 'error2');
        }
        /*return $selectruangan[0].nama_ruangan;*/
        /*dd($request->nama_ruang, $galat);*/

        if (array_has($galat, '1')) {
            return redirect('admin/acara/create')->with(session()->flash('dateError', ''))
                ->withInput();
        } elseif (array_has($galat, '2')) {
            return redirect('admin/acara/create')->with(session()->flash('dateTimeError', ''))
                ->withInput();
        } else {

        /*berarti logikanya di store ini ada 2 kali fungsi
        pertama fungsi store ke db
        kedua create event ke eventcalendar nya*/

        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:25', new Uppercase],
            'tamu_undangan.*' => ['required', 'email'],
            'nama_ruang' => ['required'],
            'reminder' => ['required', 'numeric', 'max:60'],
            'id_gedung' => ['required'],
            'start_date' => ['required'],
        ]);

        /*fungsi store google calendar*/
        $event = Event::create([
            'name' => $request->nama_acara,
            'startDateTime' => $start,
            'endDateTime' => $end,
            'location' => $request->nama_ruang,
            /*'attendees' => [
                'email' => $request->tamu_undangan
            ],*/
        ]);
        foreach ($request->tamu_undangan as $data){
            $event->addAttendee(['email' => $data]);
        }
        $event->save();

        dd($event);

        /*ini store ke db*/
        $acara = new Acara;
        /*event_id_google_calendar ini untuk menyimpan event_id tiap acara
        di google calendar dan menyimpannya di db.
        jadi koneksi untuk ke google calendar nya*/
        $acara->event_id_google_calendar = $event->id;
        $acara->nama_event = $request->nama_acara;
        $acara->start_date = $start;
        $acara->end_date = $end;
        $acara->alarm = $request->reminder;
        $acara->id_gedung = $request->id_gedung;
        $acara->nama_ruangan = $request->nama_ruang;
        $acara->tamu_undangan = $request->tamu_undangan;
        $acara->penanggung_jawab = Auth::user()->id_admin;
        $acara->save();




        return redirect('admin/acara')->with(session()->flash('status', ''));
        }
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
        $acara = Acara::find($id);
        return view('Admin.ShowAcara')->with('acara', $acara);
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
        $gedung = Gedung::all();
        $ruangan = Ruangan::all();
        $acara = Acara::find($id);
        return view('Admin.EditAcara')
            ->with('gedung', $gedung)
            ->with('ruangan', $ruangan)
            ->with('acara', $acara);
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
        $start = Carbon::parse(str_before($request->start_date, ' -'), 'Asia/Jakarta');
        $end = Carbon::parse(str_after($request->start_date, '- '), 'Asia/Jakarta');
        if ($start < Carbon::today()){
            return redirect('admin/acara/'.$id.'/edit')->with(session()->flash('dateError', ''));
        } else {
            $validasi = $request->validate([
                'nama_acara' => ['required', 'max:25', new Uppercase],
                'tamu_undangan' => ['required', 'email'],
                'nama_ruang' => ['required'],
                'id_gedung' => ['required'],
                'start_date' => ['required']
            ]);


            $acara = Acara::find($id);
            $acara->nama_event = $request->nama_acara;
            $acara->tamu_undangan = $request->tamu_undangan;
            $acara->start_date = $start;
            $acara->end_date = $end;
            $acara->id_gedung = $request->id_gedung;
            $acara->nama_ruangan = $request->nama_ruang;
            $acara->save();


            /*$event->update([
                'name' => $request->nama_acara,
                'startDateTime' => Carbon::parse($start, 'Asia/Jakarta'),
                'endDateTime' => Carbon::parse($end, 'Asia/Jakarta'),
            ]);*/
            $event = Event::find($acara->event_id_google_calendar);
            $event->name = $request->nama_acara;
            $event->startDateTime = $start;
            $event->endDateTime = $end;
            $event->addAttendee(['email' => $request->tamu_undangan]);
            $event->save();

            /*$event = Event::find($acara->event_id_google_calendar)->update($request->all());*/

            return redirect('admin/acara')->with(session()->flash('update', ''));
        }
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

        /*ini merujuk ke column event_id_google_calendar
        yang isinya adalah event_id tiap acara
        ketika mendapatkan id nya maka di google calendar pun bisa di hapus*/
        $event = Event::find($acara->event_id_google_calendar);
        $event->delete();

        return redirect('admin/acara')->with(session()->flash('hapus', ''));
    }

}
