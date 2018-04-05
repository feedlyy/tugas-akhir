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
use App\Staff;

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
        $vokasi = Staff::query()
            ->select('email')->get();

        /*di pecah seperti ini karna untuk hasil checkbox itu return nya
        bentuk string, maka di pecah jadi bentuk normal tanpa [] atau ""*/

        /*ini untuk checkbox vokasi*/
        $string = '';
        foreach ($vokasi as $data){
            if (empty($string)){
                $string = $data->email;
            } else {
                $string = $string . " " . $data->email;
            }
        }
       /* dd($string, $vokasi);*/

        return view('Admin.TambahAcara')
            ->with('gedung', $gedung)
            ->with('string', $string)
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
//        dd(explode(' ', $request->vokasi), count(explode(' ', $request->vokasi)));


        $start = Carbon::parse(($request->start_date), 'Asia/Jakarta');
        $end = Carbon::parse(($request->end_date), 'Asia/Jakarta');

        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:25', new Uppercase],
            'tamu_undangan.*' => ['email'],
            'nama_ruang' => ['required'],
            'id_gedung' => ['required'],
            'start_date' => ['required'],
        ]);

        /*validasi untuk pengecekan ruangan pada range waktu tertentu agar tidak bentrok*/
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

        /*validasi untuk pengecekan email pada range waktu tertentu agar tidak bentrok*/
        $pengecekan2 = Tamu::query()
            ->join('acaras', 'tamus.id_acara', '=', 'acaras.id_acara')
            ->where(function ($query) use ($start, $end){
                $query->whereBetween('acaras.start_date', [$start, $end])
                    ->orWhereBetween('acaras.end_date', [$start, $end])
                    ->orWhereRaw('acaras.start_date < ? AND acaras.end_date > ?', [$start, $start])
                    ->orWhereRaw('acaras.start_date < ? AND acaras.end_date > ?', [$end, $end]);
            })
            ->where('tamus.email', '=', $request->tamu_undangan)
            ->get();
        $cek2 = count($pengecekan2);

        /*array sementara untuk menyimpan error*/
        $galat = [];

        /*ini validasi jika menambahkan jadwal kurang dari hari ini*/
        if ($start < Carbon::today()){
            $galat = array_add($galat, '1', 'error1');
        } elseif($cek > 0) { /*ini validasi untuk waktu dan ruangan*/
            $galat = array_add($galat, '2', 'error2');
        } elseif ($cek2 > 0){ /*ini validasi untuk waktu dan email*/
            $galat = array_add($galat, '3', 'error3');
        }

        /*dd($galat);*/

        /*jika array galat mempunyai error yang pertama*/
        if (array_has($galat, '1')) {
            return redirect('admin/acara/create')->with(session()->flash('dateError', ''))
                ->withInput();
        } elseif (array_has($galat, '2')) { /*jika array galat mempunyai error yang kedua*/
            return redirect('admin/acara/create')->with(session()->flash('RuanganError', ''))
                ->withInput();
        } elseif (array_has($galat, '3')) { /*jika array galat mempunyai error yang ketiga*/
            return redirect('admin/acara/create')->with(session()->flash('EmailError', ''))
                ->withInput();
        } else { /*jika tidak ada error maka proses store akan dilanjutkan*/

        /*berarti logikanya di store ini ada 2 kali fungsi
        pertama fungsi store ke db
        kedua create event ke eventcalendar nya*/


            /*ini untuk menyimpan semua inputan tamu, baik dari inputan atau
            checkbox*/
            $arrayTamu = [];
            /*menyimpan email dari inputan*/
            if (!empty($request->tamu_undangan))
            {
                foreach ($request->tamu_undangan as $data){
                    /*ini untuk menampung hasil dari inputan tamu_undangan*/
                    array_push($arrayTamu,$data);
                }
            }


            /*jadi foreach 3 kali*/

            /*menyimpan email dari checkbox vokasi*/
            if (!empty($request->vokasi))
            {
                foreach (explode(' ', $request->vokasi) as $hasil){
                    /*ini menampung hasil dari checkbox vokasi*/
                    array_push($arrayTamu,$hasil);
                }
            }

        /*fungsi store google calendar*/
        $event = Event::create([
            'name' => $request->nama_acara,
            'startDateTime' => $start,
            'endDateTime' => $end,
            'location' => $request->nama_ruang,
        ]);
            foreach ($arrayTamu as $Emailnya){
                $event->addAttendee(['email' => $Emailnya]);
            }
        $event->save();

        /*ini store ke db*/
        $acara = new Acara;
        /*event_id_google_calendar ini untuk menyimpan event_id tiap acara
        di google calendar dan menyimpannya di db.
        jadi koneksi untuk ke google calendar nya*/
        $acara->event_id_google_calendar = $event->id;
        $acara->nama_event = $request->nama_acara;
        $acara->start_date = $start;
        $acara->end_date = $end;
        $acara->id_gedung = $request->id_gedung;
        $acara->nama_ruangan = $request->nama_ruang;
        $acara->penanggung_jawab = Auth::user()->id_admin;
        $acara->save();


            foreach ($arrayTamu as $record){
                $tamu = new Tamu;
                $tamu->id_acara = $acara->id_acara;
                $tamu->email = $record;
                $tamu->save();
            }

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
        $query = Acara::query()
            ->join('tamus', 'acaras.id_acara', '=', 'tamus.id_acara')
            ->select('tamus.email')
            ->get();

        /*jadi ini untuk mencocokan antara penanggung jawab dengan id admin
        lalu select nama admin nya*/
        $penanggungJawab = Admin::query()
            ->join('acaras', 'admins.id_admin', '=', 'acaras.penanggung_jawab')
            ->select('admins.nama_admin')
            ->get();

        /*karena hasilnya berupa array(lebih dari satu dan sama) dan karna butuh nya cuma satu
        maka cukup ambil nilai array pertamanya*/
        $tampung = [];
        foreach ($penanggungJawab as $data){
            array_push($tampung, $data->nama_admin);
        }

        $email = Tamu::query()
            ->where('id_acara', $id)
            ->select('email')->get();

        $tampungEmail = [];
        foreach ($email as $hasil){
            array_push($tampungEmail, $hasil->email);
        }
        /*return json_encode(implode(',&nbsp', $tampungEmail));*/





        return view('Admin.ShowAcara')
            ->with('query', $query)
            ->with('acara', $acara)
            ->with('tampungEmail', $tampungEmail)
            ->with('tampung', $tampung);
            /*->with('filterPenanggungJawab', $filterPenanggungJawab);*/
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
        $tamu = Tamu::where('id_acara', $id)->select('email')->get();
        $vokasi = Staff::query()
            ->select('email')->get();

        /*di pecah seperti ini karna untuk hasil checkbox itu return nya
        bentuk string, maka di pecah jadi bentuk normal tanpa [] atau ""*/

        /*ini untuk checkbox vokasi*/
        $string = '';
        foreach ($vokasi as $data){
            if (empty($string)){
                $string = $data->email;
            } else {
                $string = $string . " " . $data->email;
            }
        }

       /* echo json_encode($tamu);
        die();*/

        return view('Admin.EditAcara')
            ->with('string', $string)
            ->with('tamu', $tamu)
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
        $start = Carbon::parse(($request->start_date), 'Asia/Jakarta');
        $end = Carbon::parse(($request->end_date), 'Asia/Jakarta');

        /*dd(explode(' ', $request->vokasi), Tamu::all('email'));*/


        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:25', new Uppercase],
            'tamu_undangan.*' => ['email'],
            'nama_ruang' => ['required'],
            'id_gedung' => ['required'],
            'start_date' => ['required']
        ]);

         /*jika tidak ada error maka proses store akan dilanjutkan*/

            /*ini untuk menyimpan semua inputan tamu, baik dari inputan atau
                        checkbox*/
            $arrayTamu = [];
            /*menyimpan email dari inputan*/
            if (!empty($request->tamu_undangan))
            {
                foreach ($request->tamu_undangan as $data){
                    /*ini untuk menampung hasil dari inputan tamu_undangan*/
                    array_push($arrayTamu,$data);
                }
            }

            /*jadi foreach 3 kali*/

            /*menyimpan email dari checkbox vokasi*/
            if (!empty($request->vokasi))
            {
                foreach (explode(' ', $request->vokasi) as $hasil){
                    /*ini menampung hasil dari checkbox vokasi*/
                    array_push($arrayTamu,$hasil);
                }
            }

            $acara = Acara::find($id);
            $acara->nama_event = $request->nama_acara;
            $acara->start_date = $start;
            $acara->end_date = $end;
            $acara->id_gedung = $request->id_gedung;
            $acara->nama_ruangan = $request->nama_ruang;
            $acara->save();


            /*bagian sini yang mash blm bener*/

            /*Tamu::where('id_acara', $id)
                ->whereNotIn('email', $arrayTamu)
                ->delete();

            foreach($arrayTamu as $key) {
                Tamu::firstOrCreate(
                    ['id_acara' => $id, 'email' => $key]
                );
            }*/
        /*foreach ($arrayTamu as $hasil){
            $tamu = Tamu::updateOrCreate(
                ['id_acara' => $id],
                $hasil
            );
        }*/




            /*kalau update google pake method ini ga bisa, jadi harus pake object/eloquent*/
            /*$event->update([
                'name' => $request->nama_acara,
                'startDateTime' => Carbon::parse($start, 'Asia/Jakarta'),
                'endDateTime' => Carbon::parse($end, 'Asia/Jakarta'),
            ]);*/
            $event = Event::find($acara->event_id_google_calendar);
            $event->name = $request->nama_acara;
            $event->startDateTime = $start;
            $event->endDateTime = $end;
            foreach ($arrayTamu as $Emailnya){
                $event->addAttendee(['email' => $Emailnya]);
            }
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
