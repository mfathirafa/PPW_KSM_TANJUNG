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
                        <a href="#" class="sub-link text-success">Dari 10 Tagihan</a>
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
                        <h4 class="card-title fw-bold mb-1">7</h4>
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
                        <h4 class="card-title fw-bold mb-1">Rp 15.000</h4>
                        <a href="#" class="sub-link text-success">3 Transaksi</a>
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
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th>Bulan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ahmad Rizki</td>
                        <td>April 2025</td>
                        <td>Rp. 5.000</td>
                        <td><span class="badge bg-lunas rounded-pill">Lunas</span></td>
                    </tr>
                    <tr>
                        <td>Faisal Gunawan</td>
                        <td>April 2025</td>
                        <td>Rp. 5.000</td>
                        <td><span class="badge bg-belum-lunas rounded-pill text-dark">Belum Lunas</span></td>
                    </tr>
                    <tr>
                        <td>Aceng</td>
                        <td>April 2025</td>
                        <td>Rp. 5.000</td>
                        <td><span class="badge bg-terlambat rounded-pill">Terlambat</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection