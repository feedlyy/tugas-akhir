<?php

use Illuminate\Database\Seeder;

class FakultasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('fakultas')->insert([
            'id_fakultas' => 'vokasi',
            'nama_fakultas' => 'Sekolah Vokasi'
        ]);
    }
}
