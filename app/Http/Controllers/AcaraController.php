<?php

namespace App\Http\Controllers;

use App\Acara;
use App\Admin;
use App\Fakultas;
use App\Prodi;
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


        return view('Admin.Acara')
            ->with('acara', $acara);
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
        $start = Carbon::parse(($request->start_date), 'Asia/Jakarta');
        $end = Carbon::parse(($request->end_date), 'Asia/Jakarta');

        $fakultas = Staff::query()
            ->select('email')
            ->where('id_fakultas', '=', 'vokasi')/*
            ->where('id_departemen', '=', null)
            ->where('id_departemen', '=', null)*/->get();

        $arrayTamu = [];
        /*menyimpan email dari inputan tamu undangan*/
        if (!empty($request->tamu_undangan))
        {
            foreach ($request->tamu_undangan as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu,$data);
            }
        }

        /*menyimpan email dari inputan staff fakultas*/
        if (!empty($request->summary1))
        {
            foreach ($request->summary1 as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu, $data);
            }
        }

        /*menyimpan email dari inputan staff departemen*/
        if (!empty($request->summary2))
        {
            foreach ($request->summary2 as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu, $data);
            }
        }

        /*menyimpan email dari inputan staff prodi*/
        if (!empty($request->summary3))
        {
            foreach ($request->summary3 as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu, $data);
            }
        }



        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:50', new Uppercase],
            'tamu_undangan.*' => ['email'],
            'summary1.*' => ['email'],
            'summary2.*' => ['email'],
            'summary3.*' => ['email'],
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
            ->where('tamus.email', '=',$arrayTamu)
            ->get();
        $cek2 = count($pengecekan2);


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
        $acara->penanggung_jawab = Auth::user()->username;
        $acara->save();



            /*ini email tamu tidak berada di antara array tamu, maka delete*/
            Tamu::whereNotIn('email', $arrayTamu)->where('id_acara', $acara->id_acara)->delete();
            foreach ($arrayTamu as $key){
                /*ketika kolom email yang ada di db tamu sama dengan arrayTamu, hitung jumlahnya*/
                $jmlTamu = Tamu::query()->
                where('email', $key)->where('id_acara', $acara->id_acara)->count();
                /*ketika jumlahnya 0 atau data nya belum ada, maka lakukan insert*/
                if($jmlTamu == 0) {
                    $tamu = new Tamu;

                    /*ini untuk mencari id fakultas,departemen, maupun prodi
                    dari table staff. agar setiap email mempunyai identitas nya dan dapat
                    di insertkan ke database Tamu*/
                    $select = Staff::query()
                        ->select('id_fakultas', 'id_departemen', 'id_prodi')
                        ->where('email', $key)
                        ->get();

                    /*ketika hasilnya di dapatkan maka akan di store ke db tamu sesuai
                    dengan id nya*/
                    foreach ($select as $hasil){
                        $tamu->id_fakultas = $hasil->id_fakultas;
                        $tamu->id_departemen = $hasil->id_departemen;
                        $tamu->id_prodi = $hasil->id_prodi;
                    }

                    $tamu->id_acara = $acara->id_acara;
                    $tamu->email = $key;
                    $tamu->save();
                }
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
            ->select('admins.username')
            ->get();

        /*karena hasilnya berupa array(lebih dari satu dan sama) dan karna butuh nya cuma satu
        maka cukup ambil nilai array pertamanya*/
        $tampung = [];
        foreach ($penanggungJawab as $data){
            array_push($tampung, $data->username);
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

        $tampungFakultas = ['vokasi' => 'not'];

        $tampungDepartemen = ['dbsmb' => 'not',
            'deb' => 'not', 'dtb' => 'not', 'dtm' => 'not', 'likes' => 'not', 'sipil' => 'not',
            'tedi' => 'not', 'thv' => 'not'];

        $tampungProdi = ['agroindustri' => 'not', 'akutansi' => 'not', 'd4 alat berat' => 'not',
            'd4 kebidanan' => 'not', 'd4 sipil' => 'not', 'd4 tekjar' => 'not',
            'ekonomi terapan' => 'not', 'elektro' => 'not', 'elins' => 'not',
            'geomatika' => 'not', 'keswan' => 'not', 'komsi' => 'not', 'manajemen' => 'not',
            'mesin' => 'not', 'metins' => 'not', 'pejesig' => 'not', 'pengelolaan hutan' => 'not',
            'rekmed' => 'not', 'sipil' => 'not'];

        /*get email dari tamu undangan*/
        $tamu = Tamu::query()
            ->select('email')
            ->where('id_acara', $id)
            ->where('id_fakultas', '=', null)
            ->where('id_departemen', '=', null)
            ->where('id_prodi', '=', null)
            ->get();

        /*get email dari fakultas*/
        $fakultas = Tamu::query()
            ->select('email', 'id_fakultas', 'id_departemen', 'id_prodi')
            ->where('id_acara', $id)
            ->where('id_fakultas', '!=', null)
            ->where('id_departemen', '=', null)
            ->where('id_prodi', '=', null)
            ->get();

        /*get email dari departemen*/
        $departemen = Tamu::query()
            ->select('email', 'id_fakultas', 'id_departemen', 'id_prodi')
            ->where('id_acara', $id)
            ->where('id_fakultas', '!=', null)
            ->where('id_departemen', '!=', null)
            ->where('id_prodi', '=', null)
            ->get();

        /*get email dari prodi*/
        $prodi = Tamu::query()
            ->select('email', 'id_fakultas', 'id_departemen', 'id_prodi')
            ->where('id_acara', $id)
            ->where('id_fakultas', '!=', null)
            ->where('id_departemen', '!=', null)
            ->where('id_prodi', '!=', null)
            ->get();

        /*untuk memfilter id fakultas mana saja yang terselected*/
        foreach ($tampungFakultas as $data => $value){
            foreach ($fakultas as $hasil){
                if ($data == $hasil->id_fakultas){
                    $tampungFakultas[$data] = 'selected';
                }
            }
        }

        /*untuk memfilter id departemen mana saja yang terselected*/
        foreach ($tampungDepartemen as $data => $value){
            foreach ($departemen as $hasil){
                if ($data == $hasil->id_departemen){
                  $tampungDepartemen[$data] = 'selected';
                }
            }
        }

        /*untuk memfilter id prodi mana saja yang terselected*/
        foreach ($tampungProdi as $data => $value){
            foreach ($prodi as $hasil){
                if ($data == $hasil->id_prodi){
                    $tampungProdi[$data] = 'selected';
                }
            }
        }



        return view('Admin.EditAcara')
            ->with('tampungFakultas', $tampungFakultas)
            ->with('tampungDepartemen', $tampungDepartemen)
            ->with('tampungProdi', $tampungProdi)
            ->with('fakultas', $fakultas)
            ->with('departemen', $departemen)
            ->with('prodi', $prodi)
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



        $arrayTamu = [];
        /*menyimpan email dari inputan*/
        if (!empty($request->tamu_undangan))
        {
            foreach ($request->tamu_undangan as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu,$data);
            }
        }

        /*menyimpan email dari inputan staff fakultas*/
        if (!empty($request->summary1))
        {
            foreach ($request->summary1 as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu, $data);
            }
        }

        /*menyimpan email dari inputan staff departemen*/
        if (!empty($request->summary2))
        {
            foreach ($request->summary2 as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu, $data);
            }
        }

        /*menyimpan email dari inputan staff prodi*/
        if (!empty($request->summary3))
        {
            foreach ($request->summary3 as $data){
                /*ini untuk menampung hasil dari inputan tamu_undangan*/
                array_push($arrayTamu, $data);
            }
        }


        $validasi = $request->validate([
            'nama_acara' => ['required', 'max:25', new Uppercase],
            'tamu_undangan.*' => ['email'],
            'nama_ruang' => ['required'],
            'id_gedung' => ['required'],
            'start_date' => ['required']
        ]);


        /// start awas
        ///

        /*validasi untuk pengecekan ruangan pada range waktu tertentu agar tidak bentrok*/
        $pengecekan = Acara::query()
            ->where('nama_ruangan', '=', $request->nama_ruang)
            ->where(function ($query) use ($start, $end){
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhereRaw('start_date < ? AND end_date > ?', [$start, $start])
                    ->orWhereRaw('start_date < ? AND end_date > ?', [$end, $end]);
            })
            ->where('acaras.id_acara', '!=', $id)
            ->get();
        $cek = count($pengecekan);

        $simpenanTamu = Tamu::where('id_acara', $id)->select('email')->get()->toArray();

        /*validasi untuk pengecekan email pada range waktu tertentu agar tidak bentrok*/
        $pengecekan2 = Tamu::query()
            ->join('acaras', 'tamus.id_acara', '=', 'acaras.id_acara')
            ->where(function ($query) use ($start, $end){
                $query->whereBetween('acaras.start_date', [$start, $end])
                    ->orWhereBetween('acaras.end_date', [$start, $end])
                    ->orWhereRaw('acaras.start_date < ? AND acaras.end_date > ?', [$start, $start])
                    ->orWhereRaw('acaras.start_date < ? AND acaras.end_date > ?', [$end, $end]);
            })
            ->whereIn('tamus.email', $arrayTamu)
            ->whereNotIn('tamus.email', $simpenanTamu)
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
        } elseif($start > $end) { /*validasi jika tanggal mulai lebih dari tanggal berakhirnya*/
            $galat = array_add($galat, '4', 'error4');
        }

        /*jika array galat mempunyai error yang pertama*/
        if (array_has($galat, '1')) {
            return redirect('admin/acara/'. $id .'/edit')->with(session()->flash('dateError', ''))
                ->withInput();
        } elseif (array_has($galat, '2')) { /*jika array galat mempunyai error yang kedua*/
            return redirect('admin/acara/'. $id .'/edit')->with(session()->flash('RuanganError', ''))
                ->withInput();
        } elseif (array_has($galat, '3')) { /*jika array galat mempunyai error yang ketiga*/
            return redirect('admin/acara/'. $id .'/edit')->with(session()->flash('EmailError', ''))
                ->withInput();
        } elseif (array_has($galat, '4')) { /*jika array galat memuat error yang keempat*/
            return redirect('admin/acara/'. $id .'/edit')->with(session()->flash('date2Error', ''))
                ->withInput();
        }

        ///
        /// end awas

            $acara = Acara::find($id);
            $acara->nama_event = $request->nama_acara;
            $acara->start_date = $start;
            $acara->end_date = $end;
            $acara->id_gedung = $request->id_gedung;
            $acara->nama_ruangan = $request->nama_ruang;
            $acara->save();



            Tamu::whereNotIn('email', $arrayTamu)->where('id_acara', $id)->delete();
            foreach ($arrayTamu as $key){
                $jmlTamu = Tamu::where('email', $key)->where('id_acara', $id)->count();
                if($jmlTamu == 0) {
                    $tamu = new Tamu;
                    $tamu->id_acara = $id;
                    /*ini untuk mencari id fakultas,departemen, maupun prodi
                    dari table staff. agar setiap email mempunyai identitas nya dan dapat
                    di insertkan ke database Tamu*/
                    $select = Staff::query()
                        ->select('id_fakultas', 'id_departemen', 'id_prodi')
                        ->where('email', $key)
                        ->get();

                    /*ketika hasilnya di dapatkan maka akan di store ke db tamu sesuai
                    dengan id nya*/
                    foreach ($select as $hasil){
                        $tamu->id_fakultas = $hasil->id_fakultas;
                        $tamu->id_departemen = $hasil->id_departemen;
                        $tamu->id_prodi = $hasil->id_prodi;
                    }
                    $tamu->email = $key;
                    $tamu->save();
                }
            }



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
