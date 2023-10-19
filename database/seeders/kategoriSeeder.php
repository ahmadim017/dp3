<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['kategori' => 'NABATI'],
            ['kategori' => 'HEWANI'],
        ];

        // Masukkan data ke dalam tabel 'categories'
        DB::table('kategori')->insert($categories);
    }
}
