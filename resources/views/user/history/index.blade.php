@extends('layouts.user')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="container" style="max-width: 900px;">
    
    <h2 class="page-title">Riwayat Transaksi Pembayaran</h2>

    <div class="filter-container">
        <div class="row g-3">
            <div class="col-md-6">
                <select class="filter-select">
                    <option selected disabled>Status Pembayaran</option>
                    <option value="all">Semua</option>
                    <option value="confirmed">Terkonfirmasi</option>
                    <option value="pending">Menunggu pembayaran</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="filter-select">
                    <option selected disabled>Tanggal Jatuh Tempo</option>
                    <option value="newest">Terbaru</option>
                    <option value="oldest">Terlama</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6 mb-4">
            <div class="history-card">
                <div>
                    <div class="card-header-row">
                        <span class="bill-number">Tagihan #12344</span>
                        <span class="badge-status badge-confirmed">Terkonfirmasi</span>
                    </div>
                    <div class="bill-date">16 Maret 2025</div>
                </div>
                
                <div class="card-footer-row">
                    <span class="payment-method">Qris</span>
                    <span class="bill-amount">Rp. 15.000</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="history-card">
                <div>
                    <div class="card-header-row">
                        <span class="bill-number">Tagihan #12345</span>
                        <span class="badge-status badge-pending">Menunggu pembayaran</span>
                    </div>
                    <div class="bill-date">29 April 2025</div>
                </div>

                <div class="card-footer-row">
                    <span class="payment-method">Qris</span>
                    <span class="bill-amount">Rp. 15.000</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="history-card">
                <div>
                    <div class="card-header-row">
                        <span class="bill-number">Tagihan #12343</span>
                        <span class="badge-status badge-confirmed">Terkonfirmasi</span>
                    </div>
                    <div class="bill-date">17 Februari 2025</div>
                </div>

                <div class="card-footer-row">
                    <span class="payment-method">Qris</span>
                    <span class="bill-amount">Rp. 15.000</span>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="history-card">
                <div>
                    <div class="card-header-row">
                        <span class="bill-number">Tagihan #12344</span>
                        <span class="badge-status badge-pending">Menunggu pembayaran</span>
                    </div>
                    <div class="bill-date">16 Mei 2025</div>
                </div>

                <div class="card-footer-row">
                    <span class="payment-method">Qris</span>
                    <span class="bill-amount">Rp. 15.000</span>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection