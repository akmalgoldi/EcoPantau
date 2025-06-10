@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Riwayat Laporan Sampah Saya</div>

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

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Daftar Laporan Anda</h4>
                        <a href="{{ route('user.reports.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-1"></i> Buat Laporan Baru
                        </a>
                    </div>

                    @if ($reports->isEmpty())
                        <div class="alert alert-info border-0 shadow-sm text-center py-4" role="alert">
                            <i class="bi bi-info-circle-fill me-2"></i> Anda belum memiliki riwayat laporan.
                            <p class="mt-2 mb-0">Klik tombol "Buat Laporan Baru" di atas untuk memulai.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Lokasi</th>
                                        <th>Deskripsi Singkat</th>
                                        <th>Status</th>
                                        <th>Tanggal Lapor</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->id }}</td>
                                            <td>{{ $report->location }}</td>
                                            <td>{{ Str::limit($report->description, 50) }}</td>
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
                        <div class="d-flex justify-content-center mt-3">
                            {{ $reports->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @endsection