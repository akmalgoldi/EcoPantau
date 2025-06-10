@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm"> {{-- Tambahkan shadow-sm --}}
                <div class="card-header">Detail Laporan Sampah #{{ $report->id }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm" role="alert"> {{-- Tambahkan border-0 shadow-sm --}}
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm" role="alert"> {{-- Tambahkan border-0 shadow-sm --}}
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class mb-3">
                        <strong><i class="bi bi-person-fill me-2"></i>Pelapor:</strong> {{ $report->user->name }}
                    </div>
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
                        <strong><i class="bi bi-info-circle-fill me-2"></i>Status Saat Ini:</strong>
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

                    <hr class="my-4"> {{-- Tambahkan margin-y --}}

                    <h5 class="mb-3">Ubah Status Laporan & Catatan Penanganan</h5>
                    <form action="{{ route('admin.reports.update-status', $report->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="report_status_id" class="form-label">
                                <i class="bi bi-arrow-repeat me-2"></i>Pilih Status Baru <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('report_status_id') is-invalid @enderror" id="report_status_id" name="report_status_id" required>
                                @foreach (App\Models\ReportStatus::all() as $status)
                                    <option value="{{ $status->id }}" {{ $report->report_status_id == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('report_status_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4"> {{-- Tambahkan mb-4 --}}
                            <label for="admin_notes" class="form-label">
                                <i class="bi bi-pencil-square me-2"></i>Catatan Penanganan (Opsional)
                            </label>
                            <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes" rows="3" placeholder="Tambahkan catatan penanganan di sini...">{{ old('admin_notes', $report->admin_notes) }}</textarea>
                            @error('admin_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-start"> {{-- Menggunakan d-grid --}}
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-arrow-counterclockwise me-2"></i>Update Status
                            </button>
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali ke Daftar Laporan
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection