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
            'id_ruangan' => '123',
            'id_gedung' => 'SV',
            'nama_ruangan' => 'SV - 123',
        ]);
        DB::table('ruangans')->insert([
            'id_ruangan' => '121',
            'id_gedung' => 'SV',
            'nama_ruangan' => 'SV - 121',
        ]);
    }
}
