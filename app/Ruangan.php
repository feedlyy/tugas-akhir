<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    //
    protected $table = 'ruangans';
    protected $primaryKey = 'id_ruangan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_ruangan', 'id_gedung',
    ];
}
