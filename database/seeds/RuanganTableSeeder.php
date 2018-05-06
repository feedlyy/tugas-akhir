<?php

use Illuminate\Database\Seeder;

class RuanganTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ruangans')->insert([
            'id_ruangan' => '126',
            'id_gedung' => 'SV',
            'nama_ruangan' => 'SV - 123',
            'created_by' => 'vokasi'
        ]);
        DB::table('ruangans')->insert([
            'id_ruangan' => '121',
            'id_gedung' => 'SV',
            'nama_ruangan' => 'SV - 121',
            'created_by' => 'vokasi'
        ]);
        DB::table('ruangans')->insert([
            'id_ruangan' => '301',
            'id_gedung' => 'GP',
            'nama_ruangan' => 'GP - 301',
            'created_by' => 'vokasi'
        ]);
        DB::table('ruangans')->insert([
            'id_ruangan' => '303',
            'id_gedung' => 'GP',
            'nama_ruangan' => 'GP - 303',
            'created_by' => 'vokasi'
        ]);
        DB::table('ruangans')->insert([
            'id_ruangan' => '201',
            'id_gedung' => 'HY',
            'nama_ruangan' => 'HY - 201',
            'created_by' => 'vokasi'
        ]);
        DB::table('ruangans')->insert([
            'id_ruangan' => '202',
            'id_gedung' => 'HY',
            'nama_ruangan' => 'HY - 202',
            'created_by' => 'vokasi'
        ]);
    }
}
