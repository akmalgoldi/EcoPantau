@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm"> {{-- Tambahkan shadow-sm --}}
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error')) {{-- Tambahkan penanganan error jika ada --}}
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="text-center py-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                        <h4 class="mt-3 mb-2">Login Berhasil!</h4>
                        <p class="lead text-muted">Sistem akan mengarahkan Anda ke dashboard sesuai peran Anda.</p>
                        <p class="small text-muted mb-4">Jika tidak ada pengalihan otomatis, klik tombol di bawah.</p>
                    </div>

                    <div class="d-grid"> {{-- Gunakan d-grid untuk tombol full-width --}}
                        @auth
                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-right me-2"></i>Lanjutkan ke Dashboard Admin
                                </a>
                            @elseif (Auth::user()->isUser())
                                <a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-right me-2"></i>Lanjutkan ke Dashboard Warga
                                </a>
                            @else
                                {{-- Fallback jika role tidak dikenali --}}
                                <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-house-door-fill me-2"></i>Kembali ke Halaman Utama
                                </a>
                            @endif
                        @else
                            {{-- Ini seharusnya tidak tercapai karena halaman ini butuh login --}}
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Kembali ke Halaman Login
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @endsection