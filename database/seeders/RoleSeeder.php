<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // Import model Role

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan peran 'Warga' dan 'Admin RT' ada di tabel roles
        // firstOrCreate akan membuat jika belum ada, atau mengambil jika sudah ada
        Role::firstOrCreate(['name' => 'Warga']);
        Role::firstOrCreate(['name' => 'Admin RT']);
    }
}