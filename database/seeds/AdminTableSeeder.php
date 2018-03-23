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
           'nama_admin' => 'vokasi',
           'password' => bcrypt('vokasi'),
            'id_status' => '1',
        ]);
        DB::table('admins')->insert([
            'nama_admin' => 'tedi',
            'password' => bcrypt('tedi'),
            'id_status' => '2',
            'parent_id' => '1',
        ]);
        DB::table('admins')->insert([
            'nama_admin' => 'komsi',
            'password' => bcrypt('komsi'),
            'id_status' => '3',
            'parent_id' => '2',
        ]);
    }
}
