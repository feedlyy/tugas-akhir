<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('statuses')->insert([
           'id_status' => '1',
           'nama_status' => 'fakultas',
        ]);
        DB::table('statuses')->insert([
            'id_status' => '2',
            'nama_status' => 'departemen',
        ]);
        DB::table('statuses')->insert([
            'id_status' => '3',
            'nama_status' => 'prodi',
        ]);
    }
}
