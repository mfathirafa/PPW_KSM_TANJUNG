@extends('layouts.admin')

@section('title', 'Laporan Keuangan - KSM Tanjung')

@section('content')

<div class="text-center mb-4">
    <h3 class="fw-bold">Laporan Keuangan KSM Tanjung</h3>
</div>

{{-- ================= FILTER ================= --}}
<form method="GET" action="{{ route('admin.reports.finance') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <label class="form-label fw-bold">Bulan</label>
        <select name="bulan" class="form-select">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{ $i }}"
                    {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label fw-bold">Tahun</label>
        <select name="tahun" class="form-select">
            @for ($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}"
                    {{ request('tahun', now()->year) == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-success w-100 fw-bold">
            Terapkan Filter
        </button>
    </div>
</form>

{{-- ================= SUMMARY ================= --}}
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <p class="text-muted mb-1">Total Pemasukan</p>
                <h4 class="fw-bold">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </h4>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-danger shadow-sm">
            <div class="card-body">
                <p class="text-muted mb-1">Total Tagihan Dibuat</p>
                <h4 class="fw-bold">{{ $totalTagihan }}</h4>
            </div>
        </div>
    </div>
</div>

{{-- ================= GRAFIK ================= --}}
<div class="card shadow-sm mb-4">
    <div class="card-header text-center">
        <h5 class="fw-bold mb-0">Grafik Pemasukan Bulanan</h5>
    </div>
    <div class="card-body">
        <canvas id="financeChart" style="min-height:320px;"></canvas>
    </div>
</div>

{{-- ================= ACTION ================= --}}
<div class="card shadow-sm mb-4">
    <div class="card-body d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ route('admin.reports.finance.csv', request()->all()) }}"
           class="btn btn-outline-secondary fw-bold">
            <i class="fas fa-download me-2"></i> Download CSV
        </a>

        <a href="{{ route('admin.reports.finance.pdf', request()->all()) }}"
           class="btn btn-outline-success fw-bold">
            <i class="fas fa-file-pdf me-2"></i> Generate PDF
        </a>
    </div>
</div>

{{-- ================= DETAIL BULANAN ================= --}}
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="fw-bold mb-0">Detail Laporan Bulanan</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Total Pemasukan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanBulanan as $row)
                        <tr>
                            <td>
                                {{ \Carbon\Carbon::create()->month($row->bulan)->translatedFormat('F') }}
                                {{ $row->tahun }}
                            </td>
                            <td>
                                Rp {{ number_format($row->total_pemasukan, 0, ',', '.') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.reports.finance.pdf', [
                                    'bulan' => $row->bulan,
                                    'tahun' => $row->tahun
                                ]) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Cetak <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data laporan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('financeChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Pemasukan',
                data: @json($chartData),
                backgroundColor: '#34D399'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value =>
                            'Rp ' + new Intl.NumberFormat('id-ID').format(value)
                    }
                }
            }
        }
    });
});
</script>
@endpush