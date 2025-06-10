@extends('layouts.app') {{-- Tetap gunakan layout dasar untuk navbar, footer, dan Bootstrap --}}

@section('content')

<header class="py-5 bg-light border-bottom mb-4 custom-hero-section">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-dark mb-2">Pantau Sampah, Jaga Lingkungan Bersih!</h1>
                    <p class="lead text-muted mb-4">EcoPantau adalah sistem pemantauan sampah berbasis komunitas yang dirancang untuk menjaga lingkungan RT/RW Anda tetap bersih dan nyaman.</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        @guest
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('register') }}">Bergabung Sekarang</a>
                            <a class="btn btn-outline-primary btn-lg px-4" href="{{ route('login') }}">Sudah Punya Akun? Masuk</a>
                        @else
                            @if (Auth::user()->isAdmin())
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('admin.dashboard') }}">Dashboard Admin Anda</a>
                            @elseif (Auth::user()->isUser())
                                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{ route('user.dashboard') }}">Dashboard Warga Anda</a>
                            @endif
                            <a class="btn btn-outline-primary btn-lg px-4" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="py-5" id="features">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h2 class="fw-bolder mb-0">Apa yang Bisa Anda Lakukan dengan EcoPantau?</h2>
            </div>
            <div class="col-lg-8">
                <div class="row gx-5 row-cols-1 row-cols-md-2">
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-pin-map-fill"></i></div>
                        <h2 class="h5">Laporkan Lokasi Sampah</h2>
                        <p class="mb-0">Laporkan tumpukan sampah liar dengan mudah. Cukup isi form singkat, sertakan lokasi dan foto.</p>
                    </div>
                    <div class="col mb-5 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-eye-fill"></i></div>
                        <h2 class="h5">Pantau Status Laporan</h2>
                        <p class="mb-0">Dapatkan update real-time tentang status penanganan laporan Anda (Baru, Diproses, Selesai).</p>
                    </div>
                    <div class="col mb-5 mb-md-0 h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people-fill"></i></div>
                        <h2 class="h5">Berkontribusi untuk Lingkungan</h2>
                        <p class="mb-0">Jadilah bagian dari solusi untuk menciptakan lingkungan RT/RW yang bersih dan sehat untuk semua.</p>
                    </div>
                    <div class="col h-100">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-bar-chart-fill"></i></div>
                        <h2 class="h5">Data & Analisis (Admin)</h2>
                        <p class="mb-0">Bagi admin, dapatkan ringkasan laporan dan manajemen pengguna yang terpusat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Anda bisa menambahkan footer di sini jika app.blade.php tidak memiliki footer global --}}

@endsection

@section('scripts')
    {{-- Hapus baris ini karena Bootstrap Icons sudah di-load di layouts/app.blade.php (di bagian <head>) --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
@endsection