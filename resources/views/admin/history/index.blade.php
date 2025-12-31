@extends('layouts.admin')

@section('title', 'Riwayat Pembayaran')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">Riwayat Pembayaran</h4>
    </div>
</div>

<div class="row">
@forelse ($riwayat as $item)
    <div class="col-lg-6">
        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <span class="text-muted">
                            #TAG-{{ $item->tagihan->id }}
                        </span>

                        <h5 class="fw-bold mb-0">
                            {{ $item->tagihan->pelanggan->user->name ?? '-' }}
                        </h5>

                        <small class="text-muted">
                            {{ $item->tagihan->pelanggan->user->phone ?? '-' }}
                        </small>

                        <p class="mt-2 mb-1">
                            Jatuh Tempo :
                            <strong>{{ $item->tagihan->deadline }}</strong>
                        </p>
                    </div>

                    <span class="badge bg-success rounded-pill">
                        LUNAS
                    </span>
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-success">
                        Rp {{ number_format($item->tagihan->jumlah, 0, ',', '.') }}
                    </span>

                    <small class="text-muted">
                        {{ $item->created_at->translatedFormat('d F Y') }}
                    </small>
                </div>

            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div class="alert alert-light text-center">
            Belum ada riwayat pembayaran
        </div>
    </div>
@endforelse
</div>

@endsection