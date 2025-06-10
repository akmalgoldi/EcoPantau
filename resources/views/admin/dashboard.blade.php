@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header">Dashboard Admin EcoPantau</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success border-0 shadow-sm" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger border-0 shadow-sm" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h4 class="mb-4 text-dark">Statistik Sistem</h4>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-primary shadow-sm h-100 border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-title mb-0">Total Laporan</h5>
                                            <p class="card-text fs-3">{{ $totalReports }}</p>
                                        </div>
                                        <i class="bi bi-bar-chart-fill" style="font-size: 2.5rem; opacity: 0.7;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-warning shadow-sm h-100 border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-title mb-0">Laporan Baru</h5>
                                            <p class="card-text fs-3">{{ $pendingReports }}</p>
                                        </div>
                                        <i class="bi bi-hourglass-split" style="font-size: 2.5rem; opacity: 0.7;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-info shadow-sm h-100 border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-title mb-0">Laporan Diproses</h5>
                                            <p class="card-text fs-3">{{ $processedReports }}</p>
                                        </div>
                                        <i class="bi bi-arrow-repeat" style="font-size: 2.5rem; opacity: 0.7;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-success shadow-sm h-100 border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-title mb-0">Laporan Selesai</h5>
                                            <p class="card-text fs-3">{{ $completedReports }}</p>
                                        </div>
                                        <i class="bi bi-check-circle-fill" style="font-size: 2.5rem; opacity: 0.7;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card text-white bg-dark shadow-sm h-100 border-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h5 class="card-title mb-0">Total Warga Terdaftar</h5>
                                            <p class="card-text fs-3">{{ $totalUsers }}</p>
                                        </div>
                                        <i class="bi bi-people-fill" style="font-size: 2.5rem; opacity: 0.7;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-4 text-dark">Distribusi Status Laporan</h4>
                    <div class="row">
                        <div class="col-md-8 offset-md-2"> {{-- Sedikit lebih lebar --}}
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Laporan Berdasarkan Status</h6>
                                </div>
                                <div class="card-body">
                                    <div style="height: 300px;"> {{-- Berikan tinggi eksplisit untuk grafik --}}
                                        <canvas id="reportStatusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-primary btn-lg me-md-2">
                            <i class="bi bi-list-task me-2"></i>Kelola Laporan
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-lg">
                            <i class="bi bi-people-fill me-2"></i>Kelola Pengguna
                        </a>
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
                            labels: {
                                font: {
                                    size: 14 // Ukuran font legend
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Persentase Laporan per Status',
                            font: {
                                size: 16 // Ukuran font judul grafik
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endsection    