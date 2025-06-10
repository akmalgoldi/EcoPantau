<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;    // Pastikan model Report diimport
use App\Models\User;     // Pastikan model User diimport
use App\Models\ReportStatus; // <--- PASTIKAN INI DIIMPORT
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReports = Report::count();
        // Menghitung laporan berdasarkan nama status
        $pendingReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Baru');
        })->count();
        $processedReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Diproses');
        })->count();
        $completedReports = Report::whereHas('status', function ($query) {
            $query->where('name', 'Selesai');
        })->count();
        // Menghitung total user dengan role Warga
        $totalUsers = User::whereHas('role', function ($query) {
            $query->where('name', 'Warga');
        })->count();

        // --- BAGIAN TAMBAHAN UNTUK DATA GRAFIK STATISTIK ---
        $reportStatuses = ReportStatus::all(); // Ambil semua status laporan yang tersedia
        $statusCounts = []; // Untuk menyimpan jumlah laporan per status
        $statusLabels = []; // Untuk menyimpan nama status sebagai label grafik
        $statusColors = [ // Definisi warna untuk setiap status (bisa disesuaikan)
            'Baru' => '#ffc107',    // Kuning (Bootstrap warning)
            'Diproses' => '#17a2b8', // Biru muda (Bootstrap info)
            'Selesai' => '#28a745',  // Hijau (Bootstrap success)
            'Default' => '#6c757d',  // Abu-abu (Bootstrap secondary), sebagai fallback
        ];
        $chartDataColors = []; // Untuk menyimpan warna yang akan digunakan di grafik

        foreach ($reportStatuses as $status) {
            $count = Report::where('report_status_id', $status->id)->count();
            $statusCounts[] = $count; // Tambahkan jumlah laporan ke array
            $statusLabels[] = $status->name; // Tambahkan nama status ke array label
            // Ambil warna berdasarkan nama status, jika tidak ada gunakan warna 'Default'
            $chartDataColors[] = $statusColors[$status->name] ?? $statusColors['Default'];
        }
        // --- AKHIR BAGIAN TAMBAHAN ---

        // Mengirim semua data (termasuk data grafik) ke view dashboard admin
        return view('admin.dashboard', compact(
            'totalReports',
            'pendingReports',
            'processedReports',
            'completedReports',
            'totalUsers',
            'statusCounts',    // Data jumlah laporan per status
            'statusLabels',    // Label nama status
            'chartDataColors'  // Warna untuk grafik
        ));
    }
}