<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    //
    protected $table = 'gedungs';
    protected $primaryKey = 'id_gedung';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_gedung',
    ];

}
