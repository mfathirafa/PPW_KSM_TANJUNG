@extends('layouts.admin')

@section('title', 'Kelola Pelanggan')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="fw-bold mb-0">Daftar Pelanggan</h4>
    </div>
</div>

@forelse ($customers as $customer)
<div class="card shadow-sm mb-3">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <h5 class="fw-bold mb-0">
                    {{ $customer->user->name }}
                </h5>
                <small class="text-muted">
                    {{ $customer->user->phone }}
                </small>
            </div>
            <span class="badge bg-success">Aktif</span>
        </div>

        <p class="text-muted mb-2">
            Total Tagihan: {{ $customer->tagihans->count() }}
        </p>

        {{-- HISTORY --}}
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Tanggal Bayar</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($customer->tagihans as $tagihan)
                    @forelse ($tagihan->pembayarans as $bayar)
                        <tr>
                            <td>{{ $tagihan->bulan }}</td>
                            <td>{{ $bayar->created_at->translatedFormat('d F Y') }}</td>
                            <td>
                                Rp {{ number_format($tagihan->jumlah, 0, ',', '.') }}
                            </td>
                            <td>
                                @if ($bayar->status === 'accepted')
                                    <span class="badge bg-success">Lunas</span>
                                @elseif ($bayar->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada pembayaran
                            </td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Belum ada tagihan
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@empty
<div class="alert alert-light text-center">
    Belum ada pelanggan
</div>
@endforelse

@endsection