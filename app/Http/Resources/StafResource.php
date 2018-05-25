<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class StafResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id_staff' => $this->id_staff,
            'id_fakultas' => $this->id_fakultas,
            'id_departemen' => $this->id_departemen,
            'id_prodi' => $this->id_prodi,
            'nip' => $this->nip,
            'nama_staff' => $this->nama_staff,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'id_status' => $this->id_status,
            'created_at' => $this->craeted_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
