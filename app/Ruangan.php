<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    //
    protected $table = 'ruangans';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'id_ruangan', 'nama_ruangan', 'id_gedung', 'created_by'
    ];


}
