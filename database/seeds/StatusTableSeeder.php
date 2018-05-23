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
           'id' => '1',
           'jabatan' => 'petinggi',
        ]);
        DB::table('statuses')->insert([
            'id' => '2',
            'jabatan' => 'standar',
        ]);
    }
}
