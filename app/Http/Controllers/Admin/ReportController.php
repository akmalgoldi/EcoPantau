<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;      
use App\Models\ReportStatus; 
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Menampilkan daftar semua laporan untuk admin
    public function index()
    {
        $reports = Report::with(['user', 'status'])->latest()->paginate(10);
        return view('admin.reports.index', compact('reports'));
    }

    // Menampilkan detail laporan tertentu
    public function show(Report $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    // Menampilkan form untuk mengedit laporan (terutama status dan catatan admin)
    public function edit(Report $report)
    {
        $statuses = ReportStatus::all(); // Ambil semua status laporan
        return view('admin.reports.edit', compact('report', 'statuses'));
    }

    // Memperbarui laporan (location, description, status, notes)
    public function update(Request $request, Report $report)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'report_status_id' => 'required|exists:report_statuses,id',
            'admin_notes' => 'nullable|string',
        ]);

        $report->update($request->all());

        return redirect()->route('admin.reports.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    // Fungsi khusus untuk update status laporan dan catatan admin
    public function updateStatus(Request $request, Report $report)
    {
        $request->validate([
            'report_status_id' => 'required|exists:report_statuses,id',
            'admin_notes' => 'nullable|string',
        ]);

        $report->update([
            'report_status_id' => $request->report_status_id,
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('admin.reports.show', $report)->with('success', 'Status laporan berhasil diperbarui.');
    }
}