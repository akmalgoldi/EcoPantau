@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Laporan Sampah #{{ $report->id }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="bi bi-geo-alt-fill me-2"></i>Lokasi:</strong> {{ $report->location }}
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-card-text me-2"></i>Deskripsi:</strong> <br> {{ $report->description }}
                    </div>
                    @if ($report->photo)
                        <div class="mb-3">
                            <strong><i class="bi bi-image-fill me-2"></i>Foto:</strong> <br>
                            <img src="{{ Storage::url($report->photo) }}" alt="Foto Laporan" class="img-fluid rounded shadow-sm mt-2" style="max-width: 400px;">
                        </div>
                    @else
                        <div class="mb-3 text-muted">
                            <i class="bi bi-image-fill me-2"></i> Tidak ada foto terlampir.
                        </div>
                    @endif
                    <div class="mb-3">
                        <strong><i class="bi bi-info-circle-fill me-2"></i>Status:</strong>
                        <span class="badge {{
                            $report->status->name == 'Baru' ? 'bg-warning text-dark' :
                            ($report->status->name == 'Diproses' ? 'bg-info' :
                            ($report->status->name == 'Selesai' ? 'bg-success' : 'bg-secondary'))
                        }}">
                            {{ $report->status->name }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-calendar-event-fill me-2"></i>Tanggal Lapor:</strong> {{ $report->created_at->format('d M Y H:i') }}
                    </div>
                    @if ($report->admin_notes)
                        <div class="mb-3">
                            <strong><i class="bi bi-chat-dots-fill me-2"></i>Catatan Admin:</strong> <br> {{ $report->admin_notes }}
                        </div>
                    @endif
                    <hr>
                    <a href="{{ route('user.reports.my') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali ke Laporan Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @endsection