<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(kategoriSeeder::class);
        $this->call(mingguSeeder::class);
        $this->call(bulanSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
