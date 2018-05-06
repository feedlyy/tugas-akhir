<?php

use Illuminate\Database\Seeder;

class GedungTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('gedungs')->insert([
           'id_gedung' => 'GP',
           'nama_gedung' => 'Gedung Perpustakaan',
            'created_by' => 'vokasi'
        ]);
        DB::table('gedungs')->insert([
           'id_gedung' => 'SV',
           'nama_gedung' => 'Sekolah Vokasi',
            'created_by' => 'vokasi'
        ]);
        DB::table('gedungs')->insert([
            'id_gedung' => 'HY',
            'nama_gedung' => 'Herman Yohanes',
            'created_by' => 'vokasi'
        ]);
    }
}
