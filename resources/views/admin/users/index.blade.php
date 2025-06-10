@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm"> {{-- Tambahkan shadow-sm agar konsisten dengan show.blade.php --}}
                <div class="card-header">Daftar Pengguna (Admin)</div>

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
                        <table class="table table-bordered table-striped table-hover"> {{-- Tambahkan table-hover --}}
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th><i class="bi bi-person-fill me-2"></i>Nama</th> {{-- Tambahkan ikon Bootstrap --}}
                                    <th><i class="bi bi-envelope-fill me-2"></i>Email</th> {{-- Tambahkan ikon Bootstrap --}}
                                    <th><i class="bi bi-person-badge-fill me-2"></i>Peran</th> {{-- Tambahkan ikon Bootstrap --}}
                                    <th><i class="bi bi-calendar-event-fill me-2"></i>Terdaftar Sejak</th> {{-- Tambahkan ikon Bootstrap --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $user->role->name }}</span>
                                        </td>
                                        <td>{{ $user->created_at->format('d M Y H:i') }}</td> {{-- Sesuaikan format tanggal --}}
                                        <td>
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info me-1"> {{-- Tambahkan tombol Lihat --}}
                                                <i class="bi bi-eye-fill"></i> Lihat
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                                <i class="bi bi-pencil-fill"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Ini akan menghapus semua laporannya juga!');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" {{ Auth::user()->id === $user->id ? 'disabled' : '' }}>
                                                    <i class="bi bi-trash-fill"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada pengguna terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection