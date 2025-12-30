@extends('layouts.user')

@section('title', 'Dashboard Pelanggan')

@section('content')

<div class="mb-4">
    <h4 class="fw-bold">
        Selamat datang, {{ $user->name ?? 'Pelanggan' }}!
    </h4>
    <small class="text-muted">
        {{ now()->translatedFormat('l, d F Y') }}
    </small>
</div>

{{-- INFORMASI PELANGGAN --}}
<div class="info-card">
    <div class="card-header">
        Informasi Pelanggan
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <strong>Nama Lengkap</strong>
            <span>{{ $user->name ?? '-' }}</span>
        </li>
        <li class="list-group-item">
            <strong>Nomor Whatsapp</strong>
            <span>{{ $user->phone ?? '-' }}</span>
        </li>
        <li class="list-group-item">
            <strong>Alamat</strong>
            <span>{{ $user->pelanggan->alamat ?? '-' }}</span>
        </li>
        <li class="list-group-item">
            <strong>Role</strong>
            <span>{{ $user->role ?? '-' }}</span>
        </li>
    </ul>
</div>

{{-- INFORMASI TAGIHAN --}}
<div class="info-card">
    <div class="card-header">
        Informasi Tagihan
    </div>

    @if($tagihan)
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <strong>Bulan</strong>
                <span>
                    {{ \Carbon\Carbon::parse($tagihan->bulan . '-01')->translatedFormat('F Y') }}
                </span>
            </li>
            <li class="list-group-item">
                <strong>Status</strong>
                @if($tagihan->status === 'paid')
                    <span class="badge-custom-green">Lunas</span>
                @else
                    <span class="badge-custom-yellow">Belum Dibayar</span>
                @endif
            </li>
            <li class="list-group-item">
                <strong>Jumlah</strong>
                <span class="fw-bold">
                    Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}
                </span>
            </li>
            <li class="list-group-item">
                <strong>Deadline</strong>
                <span>
                    {{ \Carbon\Carbon::parse($tagihan->deadline)->translatedFormat('d F Y') }}
                </span>
            </li>
        </ul>

        @if($tagihan->status !== 'paid')
            <div class="card-footer bg-white p-3">
                <div class="d-grid">
                    <a href="{{ url('/bills') }}" class="btn btn-success fw-bold">
                        Bayar Sekarang
                    </a>
                </div>
            </div>
        @endif
    @else
        <div class="p-3 text-muted">
            Tidak ada tagihan aktif saat ini.
        </div>
    @endif
</div>

{{-- NOTIFIKASI --}}
<div>
    <h5 class="fw-bold mb-3">Notifikasi</h5>

    @forelse($notifikasis as $notif)
        <div class="notif-box alert-{{ $notif->tipe }}">
            <i class="fas
                @if($notif->tipe === 'success') fa-check-circle
                @elseif($notif->tipe === 'danger') fa-times-circle
                @else fa-exclamation-triangle
                @endif
            "></i>
            <div class="notif-content">
                <p>{{ $notif->isi_pesan }}</p>
                <small>{{ $notif->created_at->format('d M Y, H:i') }}</small>
            </div>
        </div>
    @empty
        <div class="text-muted">
            Tidak ada notifikasi.
        </div>
    @endforelse
</div>

@endsection
