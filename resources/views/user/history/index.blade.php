@extends('layouts.user')

@section('title', 'Riwayat Pembayaran')

@section('content')

<div class="container" style="max-width: 900px">

<h4 class="fw-bold mb-4">Riwayat Pembayaran</h4>

@forelse ($riwayat as $item)
<div class="card shadow-sm mb-3">
    <div class="card-body">

        <div class="d-flex justify-content-between">
            <div>
                <p class="fw-bold mb-1">
                    Tagihan {{ $item->tagihan->bulan }}
                </p>

                <small class="text-muted">
                    {{ $item->created_at->translatedFormat('d F Y') }}
                </small>
            </div>

            <div>
                @if ($item->status === 'accepted')
                    <span class="badge bg-success">Diterima</span>
                @elseif ($item->status === 'pending')
                    <span class="badge bg-warning text-dark">Menunggu</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p class="mb-0">
                    Metode: <strong>{{ strtoupper($item->method) }}</strong>
                </p>
                <p class="fw-bold text-success mb-0">
                    Rp {{ number_format($item->tagihan->jumlah, 0, ',', '.') }}
                </p>
            </div>

            @if ($item->status === 'accepted')
                <a href="{{ route('user.history.invoice', $item->id) }}"
                   class="btn btn-outline-primary btn-sm">
                    Invoice PDF
                </a>
            @endif
        </div>

        @if ($item->status === 'rejected' && $item->catatan_admin)
            <div class="alert alert-light mt-3">
                <strong>Catatan Admin:</strong><br>
                {{ $item->catatan_admin }}
            </div>
        @endif

    </div>
</div>
@empty
<div class="alert alert-light text-center">
    Belum ada riwayat pembayaran
</div>
@endforelse

</div>

@endsection