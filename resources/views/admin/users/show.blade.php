@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">Detail Pengguna: {{ $user->name }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="bi bi-person-fill me-2"></i>Nama:</strong> {{ $user->name }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-envelope-fill me-2"></i>Email:</strong> {{ $user->email }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-person-badge-fill me-2"></i>Peran:</strong>
                        <span class="badge bg-secondary">{{ $user->role->name }}</span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-calendar-event-fill me-2"></i>Terdaftar Sejak:</strong> {{ $user->created_at->format('d M Y H:i') }}
                    </div>
                    <hr>
                    <h5><i class="bi bi-file-text-fill me-2"></i>Laporan yang Dibuat Oleh Pengguna Ini</h5>
                    @if ($user->reports->isEmpty())
                        <div class="alert alert-info border-0 shadow-sm" role="alert">
                            Pengguna ini belum membuat laporan sampah.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>ID Laporan</th>
                                        <th>Lokasi</th>
                                        <th>Status</th>
                                        <th>Tanggal Lapor</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user->reports->sortByDesc('created_at')->take(5) as $report) 
                                        <tr>
                                            <td>{{ $report->id }}</td>
                                            <td>{{ Str::limit($report->location, 30) }}</td>
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
                                                <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye-fill"></i> Lihat Laporan
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('admin.reports.index', ['user_id' => $user->id]) }}" class="btn btn-sm btn-outline-primary mt-2">
                            Lihat Semua Laporan Pengguna Ini
                        </a>
                        
                    @endif

                    <hr class="my-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali ke Daftar Pengguna
                    </a>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-fill me-2"></i>Edit Pengguna Ini
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection