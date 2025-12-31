@extends('layouts.admin')

@section('title', 'Dashboard Admin - KSM Tanjung')

@section('content')

<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users fa-2x text-muted me-3"></i>
                    <div>
                        <p class="card-text text-muted mb-1">Total Pelanggan</p>
                        <h4 class="card-title fw-bold mb-1">{{ $totalPelanggan }}</h4>
                        <a href="#" class="sub-link text-success">3 Bulan Ini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-invoice-dollar fa-2x text-muted me-3"></i>
                    <div>
                        <p class="card-text text-muted mb-1">Total Tagihan Bulan Ini</p>
                        <h4 class="card-title fw-bold mb-1">{{ $tagihanBulanIni }}</h4>
                        <a href="#" class="sub-link text-success">Dari {{ $tagihanBulanIni }} Tagihan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card shadow-sm h-100" style="border-left-color: #ffc107;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-history fa-2x text-muted me-3"></i>
                    <div>
                        <p class="card-text text-muted mb-1">Menunggu Verifikasi</p>
                        <h4 class="card-title fw-bold mb-1">{{ $menungguVerifikasi }}</h4>
                        <a href="#" class="sub-link text-warning">Perlu ditindak lanjuti</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card summary-card shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-hand-holding-usd fa-2x text-muted me-3"></i>
                    <div>
                        <p class="card-text text-muted mb-1">Pembayaran hari ini</p>
                        <h4 class="card-title fw-bold mb-1">{{ number_format($pemasukanHariIni, 0, ',', '.') }}</h4>
                        <a href="#" class="sub-link text-success">{{ $tagihanTerbaru->count() ?? 0}} Transaksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header data-table-header d-flex justify-content-between align-items-center p-3">
        <h5 class="mb-0 fw-bold">Data Tagihan</h5>
        <a href="#" class="btn btn-light btn-sm">Lihat semua</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
               <tbody>
                @forelse ($tagihanTerbaru as $tagihan)
                    <tr>
                        <td>{{ $tagihan->pelanggan->user->name }}</td>

                        <td>{{ $tagihan->bulan }}</td>

                        <td>
                            Rp. {{ number_format($tagihan->jumlah, 0, ',', '.') }}
                        </td>

                        <td>
                            @if ($tagihan->status === 'paid')
                                <span class="badge bg-lunas rounded-pill">Lunas</span>
                            @elseif ($tagihan->status === 'unpaid')
                                <span class="badge bg-belum-lunas rounded-pill text-dark">
                                    Belum Lunas
                                </span>
                            @else
                                <span class="badge bg-terlambat rounded-pill">
                                    Terlambat
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Belum ada data tagihan
                        </td>
                    </tr>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>
</div>

@endsection