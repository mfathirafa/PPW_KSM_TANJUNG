@extends('layouts.user')

@section('title', 'Tagihan Saya')

@section('content')

<div class="container" style="max-width: 900px;">
    
    <h2 class="page-title">Daftar Tagihan</h2>

    @if($tagihans->isEmpty())
        <div class="alert alert-info text-center">
            Tidak ada tagihan saat ini.
        </div>
    @else
        <div class="row">

            @foreach($tagihans as $tagihan)
                <div class="col-md-6 mb-4">
                    <div class="history-card">

                        <div>
                            <div class="card-header-row">
                                <span class="bill-number">
                                    Tagihan {{ \Carbon\Carbon::parse($tagihan->bulan)->translatedFormat('F Y') }}
                                </span>

                                @if($tagihan->status === 'paid')
                                    <span class="badge-status badge-confirmed">Lunas</span>
                                @else
                                    <span class="badge-status badge-pending">Belum Dibayar</span>
                                @endif
                            </div>

                            <div class="bill-date">
                                Jatuh tempo: {{ \Carbon\Carbon::parse($tagihan->deadline)->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <div class="card-footer-row">
                            <span class="payment-method">
                                {{ $tagihan->pembayaran->method ?? '-' }}
                            </span>

                            <span class="bill-amount">
                                Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}
                            </span>
                        </div>

                        @if($tagihan->status === 'unpaid')
                            <div class="mt-3">
                                <a href="/bills/{{ $tagihan->id }}" class="btn btn-success w-100 fw-bold">
                                    Bayar Sekarang
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach

        </div>
    @endif

</div>

@endsection
