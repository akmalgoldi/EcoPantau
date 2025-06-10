<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); // Ini adalah contoh dari Laravel, bisa dihapus atau diubah

        $this->call([
            RoleSeeder::class,          // Panggil RoleSeeder terlebih dahulu
            ReportStatusSeeder::class,  // Kemudian ReportStatusSeeder
            // Anda bisa tambahkan seeder lain di sini, misalnya untuk membuat user admin awal
            // UserSeeder::class,
        ]);
    }
}