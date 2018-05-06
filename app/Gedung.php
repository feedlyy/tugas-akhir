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
        'id_gedung', 'nama_gedung', 'created_by'
    ];

    /*ini adalah contoh function penggunaan Accessor
    Dengan adanya Accessor kita dapat mem-format attribut yang di dapat ataupun di kirim
    penamaan fungsi nya getFooAttributes($value)
    dimana Foo ini adalah nama kolom/attribut table yang di akses
    bisa ucwords ataupun strtolower Foo nya
    contoh: misal mau custom format untuk nama gedung ketika di get
    maka bisa getNamaGedungAttributes($value) atau getnamagedungAttributes($value)*/

    /*public function getNamaGedungAttribute($value)
    {
        return strtolower($value);
    }*/


}
