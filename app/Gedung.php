<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Gedung extends Model
{
    //
    protected $table = 'gedungs';
    protected $primaryKey = 'id_gedung';

    /*fungsi incrementing ini berguna kalau primary key nya bukan integer
    misalkan string, jadi nanti dengan setting incrementing = false maka return nya ga akan 0, melainkan
    value string tersebut*/
    public $incrementing = false;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_gedung', 'nama_gedung',
    ];


}
