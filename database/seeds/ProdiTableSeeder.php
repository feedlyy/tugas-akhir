<?php

use Illuminate\Database\Seeder;

class ProdiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //tedi
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'id_prodi' => 'komsi',
            'nama_prodi' => 'Ilmu Komputer dan Sistem Informasi'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'id_prodi' => 'elins',
            'nama_prodi' => 'Teknologi Instrumentasi'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'id_prodi' => 'elektro',
            'nama_prodi' => 'Teknologi Listrik'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'id_prodi' => 'metins',
            'nama_prodi' => 'Metrologi dan Instrumentasi'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'tedi',
            'id_prodi' => 'd4 tekjar',
            'nama_prodi' => 'Teknologi Rekayasa Internet'
        ]);

        //sipil
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'sipil',
            'id_prodi' => 'sipil',
            'nama_prodi' => 'Teknik Sipil'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'sipil',
            'id_prodi' => 'd4 sipil',
            'nama_prodi' => 'Teknik Pengelolaan dan Pemeliharaan Infrastruktur Sipil'
        ]);

        //dtm
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dtm',
            'id_prodi' => 'mesin',
            'nama_prodi' => 'Teknik Mesin'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dtm',
            'id_prodi' => 'd4 alat berat',
            'nama_prodi' => 'Teknik Pengelolaan dan Perawatan Alat Berat'
        ]);

        //thv
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'thv',
            'id_prodi' => 'keswan',
            'nama_prodi' => 'Kesehatan Hewan'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'thv',
            'id_prodi' => 'agroindustri',
            'nama_prodi' => 'Agroindustri'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'thv',
            'id_prodi' => 'pengelolaan hutan',
            'nama_prodi' => 'Pengelolaan Hutan'
        ]);

        //dtb
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dtb',
            'id_prodi' => 'geomatika',
            'nama_prodi' => 'Teknik Geomatika'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dtb',
            'id_prodi' => 'pejesig',
            'nama_prodi' => 'Penginderaan Jauh dan Sistem Informasi Geografi'
        ]);

        //likes
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'likes',
            'id_prodi' => 'rekmed',
            'nama_prodi' => 'Rekam Medis'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'likes',
            'id_prodi' => 'd4 kebidanan',
            'nama_prodi' => 'Kebidanan'
        ]);

        //deb
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'deb',
            'id_prodi' => 'akutansi',
            'nama_prodi' => 'Akutansi'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'deb',
            'id_prodi' => 'manajemen',
            'nama_prodi' => 'Manajemen'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'deb',
            'id_prodi' => 'ekonomi terapan',
            'nama_prodi' => 'Ekonomi Terapan'
        ]);

        //dbsmb
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'kearsipan',
            'nama_prodi' => 'Kearsipan'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'parwi',
            'nama_prodi' => 'Kepariwisataan'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'inggris',
            'nama_prodi' => 'Bahasa Inggris'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'perancis',
            'nama_prodi' => 'Bahasa Perancis'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'jepang',
            'nama_prodi' => 'Bahasa Jepang'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'mandarin',
            'nama_prodi' => 'Bahasa Mandarin'
        ]);
        DB::table('prodis')->insert([
            'id_fakultas' => 'vokasi',
            'id_departemen' => 'dbsmb',
            'id_prodi' => 'korea',
            'nama_prodi' => 'Bahasa Korea'
        ]);
    }
}
