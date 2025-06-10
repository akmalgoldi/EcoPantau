@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Daftar Laporan Sampah (Admin)</div>

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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelapor</th>
                                    <th>Lokasi</th>
                                    <th>Deskripsi Singkat</th>
                                    <th>Status</th>
                                    <th>Tanggal Lapor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($reports as $report)
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->user->name }}</td>
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
                                            <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-info">Detail</a>
                                            {{-- Admin bisa edit, tapi fokus utama adalah update status di halaman detail --}}
                                            {{-- <a href="{{ route('admin.reports.edit', $report->id) }}" class="btn btn-sm btn-warning">Edit</a> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada laporan sampah.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $reports->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection