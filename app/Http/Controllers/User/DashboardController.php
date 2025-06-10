<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan facade Auth diimport

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil 5 laporan terbaru milik user yang sedang login
        $userReports = Auth::user()->reports()->latest()->limit(5)->get();
        return view('user.dashboard', compact('userReports'));
    }
}