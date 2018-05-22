<?php

namespace App\Http\Controllers;

use App\Acara;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Carbon\Carbon;

class HistoryAcaraController extends Controller
{
    //

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

    public function index()
    {
        $history = Acara::query()
            ->select('*')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.History')->with('history', $history);
    }

    public function destroy($id)
    {
        $acara = Acara::query()->find($id);

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
        return redirect('admin/history')->with(session()->flash('hapus', ''));
    }
}
