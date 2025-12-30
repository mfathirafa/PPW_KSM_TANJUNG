@extends('layouts.user')

@section('title', 'Riwayat Transaksi')

@section('content')

<div class="container" style="max-width: 900px;">
    
    <h2 class="page-title mb-4">Riwayat Transaksi Pembayaran</h2>

    <div class="row">

        @forelse ($riwayat as $item)
            <div class="col-md-6 mb-4">
                <div class="history-card">
                    <div>
                        <div class="card-header-row">
                            <span class="bill-number">
                                Tagihan #{{ $item->tagihan->id }}
                            </span>

                            @if ($item->status === 'accepted')
                                <span class="badge-status badge-confirmed">Terkonfirmasi</span>
                            @elseif ($item->status === 'pending')
                                <span class="badge-status badge-pending">Menunggu Pembayaran</span>
                            @else
                                <span class="badge-status badge-rejected">Ditolak</span>
                            @endif
                        </div>

                        <div class="bill-date">
                            {{ $item->created_at->translatedFormat('d F Y') }}
                        </div>
                    </div>

                    <div class="card-footer-row">
                        <span class="payment-method">
                            {{ strtoupper($item->method) }}
                        </span>

                        <span class="bill-amount">
                            Rp {{ number_format($item->tagihan->jumlah, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center">
                    Belum ada riwayat transaksi.
                </div>
            </div>
        @endforelse

    </div>
</div>

@endsection
