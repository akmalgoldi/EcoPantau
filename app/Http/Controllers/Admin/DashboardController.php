<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;    
use App\Models\User;     
use App\Models\ReportStatus; 
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
        $reportStatuses = ReportStatus::all(); 
        $statusCounts = []; 
        $statusLabels = []; 
        $statusColors = [ 
            'Baru' => '#ffc107',    
            'Diproses' => '#17a2b8', 
            'Selesai' => '#28a745',  
            'Default' => '#6c757d',  
        ];
        $chartDataColors = []; 

        foreach ($reportStatuses as $status) {
            $count = Report::where('report_status_id', $status->id)->count();
            $statusCounts[] = $count; 
            $statusLabels[] = $status->name; 
            $chartDataColors[] = $statusColors[$status->name] ?? $statusColors['Default'];
        }

        // Mengirim semua data (termasuk data grafik) ke view dashboard admin
        return view('admin.dashboard', compact(
            'totalReports',
            'pendingReports',
            'processedReports',
            'completedReports',
            'totalUsers',
            'statusCounts',   
            'statusLabels',    
            'chartDataColors'  
        ));
    }
}