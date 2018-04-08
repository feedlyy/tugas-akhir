<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    //
    public $incrementing = false; /*ini kalau id nya string*/
    protected $table = 'departemens';
    protected $primaryKey = 'id_departemen';
}
