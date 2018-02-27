<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $table = 'stafs';
    protected $primaryKey = 'id_staff';

    protected $fillable = [
      'id_status', 'nip', 'nama_staff', 'emal', 'alamat', 'no_hp',
    ];
}
