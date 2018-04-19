<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
            'id_fakultas' => 'vokasi',
            'username' => 'vokasi',
            'password' => bcrypt('vokasi'),
        ]);
        DB::table('admins')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'username' => 'tedi',
            'password' => bcrypt('tedi'),
        ]);
        DB::table('admins')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'id_prodi' => 'komsi',
            'username' => 'komsi',
            'password' => bcrypt('komsi'),
        ]);
    }
}
