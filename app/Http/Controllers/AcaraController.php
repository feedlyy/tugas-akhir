<?php

namespace App\Http\Controllers;

use App\Acara;
use App\Rules\Uppercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use App\Ruangan;
use App\Gedung;

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
        /*berarti logikanya di store ini ada 2 kali fungsi
        pertama fungsi store ke db
        kedua create event ke eventcalendar nya*/

        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:25', new Uppercase],
            'tamu_undangan' => ['required', 'email'],
            'nama_ruang' => ['required'],
            'reminder' => ['required', 'numeric', 'max:60'],
            'id_gedung' => ['required'],
            'start_date' => ['required']
        ]);

        /*jadi kan inputan date itu kayak gini, contoh
        03/17/2018 12:00 AM - 03/17/2018 11:59 PM
        nah sedangkan nanti input nya itu di pisah, start date sama end date
        jadi pake laravel string helper buat ambil valuenya masing2*/
        $start = str_before($request->start_date, ' -');
        $end = str_after($request->start_date, '- ');



//        /*ini store ke gCalendar*/
//        $event = new Event;
//        $event->name = $request->nama_acara;
//        $event->startDateTime = Carbon::parse($start, 'Asia/Jakarta');
//        $event->endDateTime = Carbon::parse($end, 'Asia/Jakarta');
//        $event->addAttendee(['email' => $request->tamu_undangan]);
//        $event->save();

        $event = Event::create([
            'name' => $request->nama_acara,
        'startDateTime' => Carbon::parse($start, 'Asia/Jakarta'),
        'endDateTime' => Carbon::parse($end, 'Asia/Jakarta'),
        ]);
        $event->addAttendee(['email' => $request->tamu_undangan]);
        $event->save();


        /*$acara= Acara::find($id);
        $event = Event::find($acara->event_id_google_calendar)->update($request);*/
        /*ini store ke db*/
        $acara = new Acara;
        /*event_id_google_calendar ini untuk menyimpan event_id tiap acara
        di google calendar dan menyimpannya di db.
        jadi koneksi untuk ke google calendar nya*/
        $acara->event_id_google_calendar = $event->id;
        $acara->nama_event = $request->nama_acara;
        $acara->start_date = Carbon::parse($start)->toDateTimeString();
        $acara->end_date = Carbon::parse($end)->toDateTimeString();
        $acara->alarm = $request->reminder;
        $acara->id_gedung = $request->id_gedung;
        $acara->nama_ruangan = $request->nama_ruang;
        $acara->tamu_undangan = $request->tamu_undangan;
        $acara->id_admin = Auth::user()->id_admin;
        $acara->save();


        return redirect('admin/acara')->with(session()->flash('status', ''));


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
        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:25', new Uppercase],
            'tamu_undangan' => ['required', 'email'],
            'nama_ruang' => ['required'],
            'id_gedung' => ['required'],
            'start_date' => ['required']
        ]);

        $start = str_before($request->start_date, ' -');
        $end = str_after($request->start_date, '- ');


        $acara = Acara::find($id);
        $acara->nama_event = $request->nama_acara;
        $acara->tamu_undangan = $request->tamu_undangan;
        $acara->start_date = Carbon::parse($start)->toDateTimeString();
        $acara->end_date = Carbon::parse($end)->toDateTimeString();
        $acara->id_gedung = $request->id_gedung;
        $acara->nama_ruangan = $request->nama_ruang;
        $acara->save();

        $event = Event::find($acara->event_id_google_calendar);
        $event->update([
            'name' => $request->nama_acara,
            'startDateTime' => Carbon::parse($start, 'Asia/Jakarta'),
            'endDateTime' => Carbon::parse($end, 'Asia/Jakarta'),
        ]);
        $event->addAttendee(['email' => $request->tamu_undangan]);
        $event->save();

        return redirect('admin/acara')->with(session()->flash('update', ''));


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
