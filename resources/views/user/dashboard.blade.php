@extends('layouts.user')

@section('title', 'Dashboard Pelanggan')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold">Selamat datang, Mbah fathi!</h4>
    <small class="text-muted">Minggu, 20 April 2025</small>
</div>

<div class="info-card">
    <div class="card-header">
        Informasi Pelanggan
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>Nama Lengkap</strong>
            <span>Fathi Setiawan</span>
        </li>
        <li class="list-group-item">
            <strong>Nomor Whatsapp</strong>
            <span>+62 876-0542-1234</span>
        </li>
        <li class="list-group-item">
            <strong>Alamat</strong>
            <span>Jl. Tanjung Raya No. 45, RT 03/RW 02</span>
        </li>
        <li class="list-group-item">
            <strong>Role</strong>
            <span>Pelanggan</span>
        </li>
    </ul>
</div>

<div class="info-card">
    <div class="card-header">
        Informasi Tagihan
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>Bulan</strong>
            <span>April 2025</span>
        </li>
        <li class="list-group-item">
            <strong>Status</strong>
            <span class="badge-custom-yellow">Belum Dibayar</span>
        </li>
        <li class="list-group-item">
            <strong>Jumlah</strong>
            <span class="fw-bold">Rp.15.000</span>
        </li>
        <li class="list-group-item">
            <strong>Deadline</strong>
            <span>30 April 2025</span>
        </li>
    </ul>
    <div class="card-footer bg-white p-3">
        <div class="d-grid">
            <button class="btn btn-success fw-bold">Bayar Sekarang</button>
        </div>
    </div>
</div>

<div>
    <h5 class="fw-bold mb-3">Notifikasi</h5>

    <div class="notif-box alert-success">
        <i class="fas fa-check-circle"></i>
        <div class="notif-content">
            <p>Tagihan bulan April 2025 telah dibuat.</p>
            <small>20 April 2025, 08:30</small>
        </div>
    </div>

    <div class="notif-box alert-danger">
        <i class="fas fa-times-circle"></i>
        <div class="notif-content">
            <p>Tagihan bulan Maret 2025 telah Terlambat.</p>
            <small>20 April 2025, 08:30</small>
        </div>
    </div>

    <div class="notif-box alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        <div class="notif-content">
            <p>Tagihan bulan Mei 2025 yang akan datang.</p>
            <small>20 April 2025, 08:30</small>
        </div>
    </div>
</div>

@endsection