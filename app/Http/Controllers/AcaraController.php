<?php

namespace App\Http\Controllers;

use App\Acara;
use App\Admin;
use App\Fakultas;
use App\Prodi;
use App\Rules\Uppercase;
use Carbon\CarbonInterval;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use App\Ruangan;
use App\Gedung;
use App\Tamu;
use App\Staff;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Google_Service_Calendar_EventAttendee;

use Spatie\GoogleCalendar\GoogleCalendarServiceProvider;

class AcaraController extends Controller
{

    protected $client;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

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

    public function oauth()
    {
        session_start();

        $rurl = action('AcaraController@oauth');
        $this->client->setRedirectUri($rurl);
        if (!isset($_GET['code'])) {
            $auth_url = $this->client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);
            return redirect($filtered_url);
        } else {
            $this->client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $this->client->getAccessToken();
            return redirect('admin');
        }
    }

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

        dd($request->nama_ruang);

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
        if ($start < Carbon::today() || $start < Carbon::now()){
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


            session_start();
            if (isset($_SESSION['access_token']) && $_SESSION['access_token'] && $_SESSION['access_token']['created'] + $_SESSION['access_token']['expires_in'] > Carbon::now()->timestamp) {
                $this->client->setAccessToken($_SESSION['access_token']);
                $service = new Google_Service_Calendar($this->client);

                $calendarId = 'primary';
                $event = new Google_Service_Calendar_Event([
                    'summary' => $request->nama_acara,
                    'location' => $request->getgedung.', ruang '.$request->nama_ruang,
                    'start' => ['dateTime' => Carbon::parse(($request->start_date), 'Asia/Jakarta')->toRfc3339String()],
                    'end' => ['dateTime' => Carbon::parse(($request->end_date), 'Asia/Jakarta')->toRfc3339String()],
                    'reminders' => array(
                        'useDefault' => FALSE,
                        'overrides' => array(
                            array('method' => 'email', 'minutes' => 60),
                            array('method' => 'popup', 'minutes' => 60),
                            array('method' => 'email', 'minutes' => 24 * 60),
                            array('method' => 'popup', 'minutes' => 24 * 60),
                        ),
                    ),
                ]);


                foreach ($arrayTamu as $emailnya)
                {
                    $attendee = new Google_Service_Calendar_EventAttendee();
                    $attendee->setEmail($emailnya);
                    $attendee_arr[]= $attendee;
                }
                $event->setAttendees($attendee_arr);
                $optParams = Array(
                    'sendNotifications' => true,
                );

                $results = $service->events->insert($calendarId, $event, $optParams);
            } else {
                return redirect()->route('oauthCallback');
            }

        /*ini store ke db*/
        $acara = new Acara;
        /*event_id_google_calendar ini untuk menyimpan event_id tiap acara
        di google calendar dan menyimpannya di db.
        jadi koneksi untuk ke google calendar nya*/
        $acara->event_id_google_calendar = $results->getId();
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
        $acara = Acara::query()->find($id);
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
            ->select('email')
            ->where('id_acara', $id)
            ->where('id_fakultas', null)
            ->where('id_departemen', null)
            ->where('id_fakultas', null)
            ->get();

        $emailfakultas = Tamu::query()
            ->select('email')
            ->where('id_acara', $id)
            ->where('id_fakultas', '!=',null)
            ->where('id_departemen', null)
            ->where('id_prodi', null)
            ->get();

        $emaildepartemen = Tamu::query()
            ->select('email')
            ->where('id_acara', $id)
            ->where('id_fakultas', '!=', null)
            ->where('id_departemen', '!=', null)
            ->where('id_prodi', null)
            ->get();

        $emailprodi = Tamu::query()
            ->select('email')
            ->where('id_acara', $id)
            ->where('id_fakultas', '!=', null)
            ->where('id_departemen', '!=', null)
            ->where('id_prodi', '!=', null)
            ->get();

        /*tampung email dari luar*/
        $tampungEmail1 = [];
        foreach ($email as $hasil){
            array_push($tampungEmail1, $hasil->email);
        }


        /*tampung email dari fakultas*/
        $tampungEmail2 = [];
        foreach ($emailfakultas as $hasil2){
            array_push($tampungEmail2, $hasil2->email);
        }

        /*tampung email dari departemen*/
        $tampungEmail3 = [];
        foreach ($emaildepartemen as $hasil3){
            array_push($tampungEmail3, $hasil3->email);
        }

        /*tampung email dari prodi*/
        $tampungEmail4 = [];
        foreach ($emailprodi as $hasil4){
            array_push($tampungEmail4, $hasil4->email);
        }


        return view('Admin.ShowAcara')
            ->with('query', $query)
            ->with('acara', $acara)
            ->with('tampungEmail1', $tampungEmail1)
            ->with('tampungEmail2', $tampungEmail2)
            ->with('tampungEmail3', $tampungEmail3)
            ->with('tampungEmail4', $tampungEmail4)
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
        /*$ruangan = Ruangan::query()
            ->join('acaras', 'ruangans.nama_ruangan', '=', 'acaras.nama_ruangan')
            ->select('ruangans.nama_ruangan')
            ->get();*/
        $ruangan = Ruangan::all();

        /*return json_encode($ruangan[0]['nama_ruangan']);*/

        /*ini untuk bagian text hidden yang mendapatkan gedung yang saat ini terselect
        agar ketika melakukan update tetapi tidak update gedung nya tidak error*/
        $cekGedung = Gedung::query()
            ->join('acaras', 'gedungs.id_gedung', '=', 'acaras.id_gedung')
            ->select('gedungs.nama_gedung')
            ->get();

        $acara = Acara::query()->find($id);

        /*setting default untuk vokasi not selected*/
        $tampungFakultas = ['vokasi' => 'not'];

        /*setting default untuk departemen not selected*/
        $tampungDepartemen = ['dbsmb' => 'not',
            'deb' => 'not', 'dtb' => 'not', 'dtm' => 'not', 'likes' => 'not', 'sipil' => 'not',
            'tedi' => 'not', 'thv' => 'not'];

        /*setting default untuk prodi not selected*/
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
            ->with('cekGedung', $cekGedung)
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

            $acara = Acara::query()->find($id);
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

        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token'] && $_SESSION['access_token']['created'] + $_SESSION['access_token']['expires_in'] > Carbon::now()->timestamp) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            // retrieve the event from the API.
            $event = $service->events->get('primary', $acara->event_id_google_calendar);

            $event->setSummary($request->nama_acara);
            $event->setLocation($request->getgedung.', ruang '.$request->nama_ruang);

            //start time
            $mulai = new Google_Service_Calendar_EventDateTime();
            $mulai->setDateTime($start->toRfc3339String());
            $event->setStart($mulai);

            //end time
            $berakhir = new Google_Service_Calendar_EventDateTime();
            $berakhir->setDateTime($end->toRfc3339String());
            $event->setEnd($berakhir);

            //attendees
            foreach ($arrayTamu as $emailnya)
            {
                $tamunya = new Google_Service_Calendar_EventAttendee();
                $tamunya->setEmail($emailnya);
                $tamunya_arr[]= $tamunya;
            }
            $event->setAttendees($tamunya_arr);

            /*ini untuk setting send notifikasinya*/
            $optParams = Array(
                'sendNotifications' => true,
            );
            $updatedEvent = $service->events->update('primary', $event->getId(), $event, $optParams);
        } else {
            return redirect()->route('oauthCallback');
        }

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

        /*ini merujuk ke column event_id_google_calendar
        yang isinya adalah event_id tiap acara
        ketika mendapatkan id nya maka di google calendar pun bisa di hapus*/
        session_start();
        if (isset($_SESSION['access_token']) && $_SESSION['access_token'] && $_SESSION['access_token']['created'] + $_SESSION['access_token']['expires_in'] > Carbon::now()->timestamp) {
            $this->client->setAccessToken($_SESSION['access_token']);
            $service = new Google_Service_Calendar($this->client);

            /*ini untuk setting send notifikasinya*/
            $optParams = Array(
                'sendNotifications' => true,
            );

            $service->events->delete('primary', $acara->event_id_google_calendar, $optParams);
        } else {
            return redirect()->route('oauthCallback');
        }

        $acara->delete();



        return redirect('admin/acara')->with(session()->flash('hapus', ''));
    }

}
