@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard Admin EcoPantau</div>

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

                    <h4 class="mb-4">Statistik Sistem</h4>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-primary">
                                <div class="card-body">
                                    <h5 class="card-title">Total Laporan</h5>
                                    <p class="card-text fs-3">{{ $totalReports }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-warning">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan Baru</h5>
                                    <p class="card-text fs-3">{{ $pendingReports }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-info">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan Diproses</h5>
                                    <p class="card-text fs-3">{{ $processedReports }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-success">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan Selesai</h5>
                                    <p class="card-text fs-3">{{ $completedReports }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-dark">
                                <div class="card-body">
                                    <h5 class="card-title">Total Warga Terdaftar</h5>
                                    <p class="card-text fs-3">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-4">Distribusi Status Laporan</h4>
                    <div class="row">
                        <div class="col-md-6 offset-md-3"> {{-- Tengah elemen grafik --}}
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Laporan Berdasarkan Status</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="reportStatusChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-primary me-md-2">Kelola Laporan</a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kelola Pengguna</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari Controller PHP, dienkode sebagai JSON
        const statusLabels = @json($statusLabels);
        const statusCounts = @json($statusCounts);
        const chartDataColors = @json($chartDataColors);

        // Pie Chart untuk Status Laporan
        const ctx = document.getElementById('reportStatusChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'doughnut', // Atau 'pie'
                data: {
                    labels: statusLabels,
                    datasets: [{
                        data: statusCounts,
                        backgroundColor: chartDataColors,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting untuk kontrol ukuran
                    plugins: {
                        legend: {
                            position: 'bottom', // Posisi legend
                        },
                        title: {
                            display: true,
                            text: 'Persentase Laporan per Status'
                        }
                    }
                }
            });
        }
    });
</script>
@endsection