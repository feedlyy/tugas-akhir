<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    //
    public $incrementing = false; /*ini kalau id nya string*/
    protected $table = 'fakultas';
    protected $primaryKey = 'id_fakultas';
}
