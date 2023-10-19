<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class bulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bulan = [
            ['bulan' => 'Januari'],
            ['bulan' => 'Februari'],
            ['bulan' => 'Maret'],
            ['bulan' => 'April'],
            ['bulan' => 'Mei'],
            ['bulan' => 'Juni'],
            ['bulan' => 'Juli'],
            ['bulan' => 'Agustus'],
            ['bulan' => 'September'],
            ['bulan' => 'Oktober'],
            ['bulan' => 'November'],
            ['bulan' => 'Desember'],
        ];

        // Masukkan data ke dalam tabel 'categories'
        DB::table('bulan')->insert($bulan);
    }
}
