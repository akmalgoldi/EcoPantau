<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

use App\Http\Controllers\HomeController;

// Import controllers Laravel UI 
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Import controller kustom 
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\ReportController as UserReportController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Halaman utama welcome
Route::get('/', function () {
    return view('welcome');
});

// Otentikasi Routes (Login, Register, Logout) - dari Laravel UI --auth
Auth::routes();

// Forgot Password & Reset Password Routes (dari Laravel UI --auth)
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


// Route /home akan dihandle oleh HomeController untuk redirect sesuai role
Route::get('/home', [HomeController::class, 'index'])->name('home');

// --- Penambahan Rute /dashboard yang me-redirect ---
// Auto redirect berdasarkan role untuk URL /dashboard
Route::get('/dashboard', function () {
    // Pastikan user sudah login
    if (Auth::check()) {
        // Redirect berdasarkan peran user
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->isUser()) {
            return redirect()->route('user.dashboard');
        }
    }
    // Jika tidak login atau role tidak dikenali, arahkan ke halaman login
    return redirect('/login');
})->name('dashboard'); // Memberi nama rute ini


// === Admin Routes ===
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Resource routes untuk laporan (kecuali create, store, destroy karena hanya user yang membuat dan tidak ada destroy dari admin di fitur ini)
    Route::resource('reports', AdminReportController::class)->except(['create', 'store', 'destroy']);
    // Route khusus untuk update status laporan
    Route::put('reports/{report}/update-status', [AdminReportController::class, 'updateStatus'])->name('reports.update-status');

    // Resource routes untuk manajemen pengguna
    Route::resource('users', AdminUserController::class)->except(['create', 'store']); // Admin tidak membuat user baru dari sini, hanya kelola
});

// === User (Warga) Routes ===
Route::prefix('user')->name('user.')->middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Resource routes untuk laporan. User bisa membuat, melihat list, melihat detail
    Route::resource('reports', UserReportController::class)->except(['edit', 'update', 'destroy']);
    // Route khusus untuk melihat riwayat laporan saya
    Route::get('my-reports', [UserReportController::class, 'myReports'])->name('reports.my');


    // Route untuk profil user
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
});