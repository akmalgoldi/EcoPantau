@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buat Laporan Sampah Baru</div>

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

                    <form action="{{ route('user.reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="location" class="form-label">
                                <i class="bi bi-geo-alt-fill me-2"></i>Lokasi Sampah <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="Contoh: Jl. Merdeka No. 10, Depan Pos Ronda" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Contoh: Nama jalan, nomor rumah, atau patokan lokasi sampah.</small>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-card-text me-2"></i>Deskripsi Laporan <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Jelaskan detail sampah yang Anda temukan, misalnya jenis sampah, ukurannya, atau hal lain yang relevan." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Informasi detail akan membantu petugas dalam penanganan.</small>
                        </div>
                        <div class="mb-4"> {{-- mb-4 untuk sedikit lebih banyak jarak di bawah --}}
                            <label for="photo" class="form-label">
                                <i class="bi bi-image-fill me-2"></i>Foto Sampah (Opsional, maks 2MB)
                            </label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Unggah foto untuk membantu petugas mengidentifikasi masalah (JPG, PNG, GIF, SVG).</small>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-start"> {{-- Menggunakan d-grid untuk tombol --}}
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle-fill me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @endsection