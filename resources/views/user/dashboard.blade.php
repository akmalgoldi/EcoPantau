@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm"> {{-- Tambahkan shadow-sm di card utama --}}
                <div class="card-header">Dashboard Warga EcoPantau</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h4 class="mb-4">Selamat datang, {{ Auth::user()->name }}!</h4>

                    <div class="alert alert-info border-0 shadow-sm" role="alert"> {{-- Tambahkan border-0 shadow-sm --}}
                        Terima kasih telah berpartisipasi dalam menjaga kebersihan lingkungan Anda.
                        Mari laporkan tumpukan sampah liar di sekitar Anda!
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="card text-white bg-primary shadow-sm h-100 border-0"> {{-- Tambahkan shadow-sm dan border-0 --}}
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><i class="bi bi-file-earmark-plus me-2"></i>Buat Laporan Baru</h5>
                                    <p class="card-text">Laporkan tumpukan sampah di sekitar Anda dengan cepat dan mudah.</p>
                                    <a href="{{ route('user.reports.create') }}" class="btn btn-light btn-sm mt-3">Mulai Laporan</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card text-white bg-secondary shadow-sm h-100 border-0"> {{-- Tambahkan shadow-sm dan border-0 --}}
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><i class="bi bi-journal-text me-2"></i>Riwayat Laporan Saya</h5>
                                    <p class="card-text">Lihat semua laporan yang pernah Anda buat dan statusnya.</p>
                                    <a href="{{ route('user.reports.my') }}" class="btn btn-light btn-sm mt-3">Lihat Riwayat</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h5 class="mt-4 mb-3">Laporan Terbaru Anda</h5>
                    @if ($userReports->isEmpty())
                        <div class="alert alert-warning border-0 shadow-sm text-center py-4" role="alert"> {{-- Tambahkan border-0 shadow-sm text-center py-4 --}}
                            <i class="bi bi-info-circle-fill me-2"></i> Anda belum memiliki laporan. Yuk, buat laporan pertama Anda!
                            <p class="mt-2 mb-0">Klik tombol "Mulai Laporan" di atas untuk memulai.</p>
                        </div>
                        {{-- Tombol Buat Laporan Sekarang dihapus karena sudah ada di kartu aksi cepat --}}
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover"> {{-- Tambahkan table-hover --}}
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Tanggal Lapor</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userReports as $report)
                                        <tr>
                                            <td>{{ $report->id }}</td>
                                            <td>{{ $report->location }}</td>
                                            <td>
                                                <span class="badge {{
                                                    $report->status->name == 'Baru' ? 'bg-warning text-dark' :
                                                    ($report->status->name == 'Diproses' ? 'bg-info' :
                                                    ($report->status->name == 'Selesai' ? 'bg-success' : 'bg-secondary'))
                                                }}">
                                                    {{ $report->status->name }}
                                                </span>
                                            </td>
                                            <td>{{ $report->created_at->format('d M Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('user.reports.show', $report->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye-fill"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('user.reports.my') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-journal-check me-2"></i>Lihat Semua Laporan Saya
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @endsection