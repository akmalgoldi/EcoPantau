<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Http\Requests\StoreReportRequest;
use App\Models\ReportStatus; // Pastikan ini diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // Menampilkan daftar semua laporan yang dibuat oleh user yang sedang login
    public function index()
    {
        $reports = Auth::user()->reports()->latest()->paginate(10);
        return view('user.reports.index', compact('reports'));
    }

    // Alias untuk index, lebih semantik untuk "Laporan Saya"
    public function myReports()
    {
        return $this->index(); // Cukup panggil method index()
    }

    // Menampilkan form untuk membuat laporan baru
    public function create()
    {
        return view('user.reports.create');
    }

    // Menyimpan laporan baru ke database
    // Kita akan menggunakan StoreReportRequest untuk validasi input
    public function store(StoreReportRequest $request)
    {
        $data = $request->validated(); // Ambil data yang sudah divalidasi
        $data['user_id'] = Auth::id(); // Otomatis assign ID user yang sedang login

        // --- KODE BARU/MODIFIKASI DIMULAI DI SINI ---
        // Dapatkan ID dari status 'Baru'
        // Penting: Pastikan ReportStatusSeeder sudah dijalankan agar status 'Baru' ada di database.
        $newStatus = ReportStatus::where('name', 'Baru')->first();

        // Tetapkan report_status_id. Jika status 'Baru' tidak ditemukan, mungkin ada masalah serius.
        if ($newStatus) {
            $data['report_status_id'] = $newStatus->id;
        } else {
            // Ini adalah fallback darurat. Seharusnya tidak terjadi jika seeder sudah dijalankan.
            // Anda bisa log error atau melempar exception yang lebih spesifik.
            return redirect()->back()->with('error', 'Kesalahan sistem: Status laporan default tidak ditemukan. Mohon hubungi administrator.');
        }
        // --- KODE BARU/MODIFIKASI SELESAI DI SINI ---

        // Handle upload foto
        if ($request->hasFile('photo')) {
            // Simpan foto ke direktori 'public/reports_photos'
            // dan dapatkan path relatif untuk disimpan di database
            $photoPath = $request->file('photo')->store('public/reports_photos');
            $data['photo'] = str_replace('public/', '', $photoPath);
        }

        Report::create($data); // Buat record laporan baru

        return redirect()->route('user.reports.my')->with('success', 'Laporan sampah berhasil dikirim!');
    }

    // Menampilkan detail laporan tertentu milik user
    public function show(Report $report)
    {
        // Pastikan user hanya bisa melihat laporannya sendiri
        if ($report->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.'); // Akses ditolak jika bukan pemilik laporan
        }
        return view('user.reports.show', compact('report'));
    }
}