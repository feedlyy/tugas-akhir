<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
    public $incrementing = false; /*ini kalau idnya string*/
    protected $table = 'prodis';
    protected $primaryKey = 'id_prodi';
}
