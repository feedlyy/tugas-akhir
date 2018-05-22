<?php

namespace App\Http\Controllers;

use App\Acara;
use Illuminate\Http\Request;

class HistoryAcaraController extends Controller
{
    //
    public function index()
    {
        $history = Acara::query()
            ->select('*')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Admin.History')->with('history', $history);
    }
}
