<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Acara extends Model
{
    //
    protected $table = 'acaras';
    protected $primaryKey = 'id_acara';

    protected $fillable = [
      'nama_event', 'tanggal_acara', 'waktu_mulai', 'waktu_selesai', 'alarm', 'id_gedung', 'id_ruangan', 'tamu_undangan', 'id_admin',
    ];

    protected $dates = [
      'tanggal_acara'
    ];
}
