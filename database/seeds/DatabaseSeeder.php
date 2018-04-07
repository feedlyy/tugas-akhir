<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            StatusTableSeeder::class,
            AdminTableSeeder::class,
            GedungTableSeeder::class,
            RuanganTableSeeder::class,
            FakultasTableSeeder::class,
            DepartemenTableSeeder::class,
            ProdiTableSeeder::class,
        ]);
    }
}
