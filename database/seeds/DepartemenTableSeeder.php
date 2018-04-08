<?php

use Illuminate\Database\Seeder;

class DepartemenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'nama_departemen' => 'Teknik Elektro dan Informatika'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'sipil',
            'nama_departemen' => 'Teknik Sipil'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'likes',
            'nama_departemen' => 'Layanan dan Informasi Kesehatan'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dtb',
            'nama_departemen' => 'Teknologi Kebumian'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'thv',
            'nama_departemen' => 'Teknologi Hayati dan Veteriner'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dtm',
            'nama_departemen' => 'Teknik Mesin'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'deb',
            'nama_departemen' => 'Ekonomika dan Bisnis'
        ]);
        DB::table('departemens')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'nama_departemen' => 'Bahasa, Seni dan Manajemen Budaya'
        ]);
    }
}
