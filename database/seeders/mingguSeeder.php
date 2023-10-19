<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class mingguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $minggu = [
            ['minggu' => 'Minggu Ke-1'],
            ['minggu' => 'Minggu Ke-2'],
            ['minggu' => 'Minggu Ke-3'],
            ['minggu' => 'Minggu Ke-4'],
            ['minggu' => 'Minggu Ke-5'],
        ];

        // Masukkan data ke dalam tabel 'categories'
        DB::table('minggu')->insert($minggu);
    }
}
