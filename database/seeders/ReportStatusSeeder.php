<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReportStatus; // Import model ReportStatus

class ReportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan status laporan 'Baru', 'Diproses', dan 'Selesai' ada
        ReportStatus::firstOrCreate(['name' => 'Baru']);
        ReportStatus::firstOrCreate(['name' => 'Diproses']);
        ReportStatus::firstOrCreate(['name' => 'Selesai']);
    }
}