@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="fw-bold mb-0">Konfirmasi Pembayaran</h4>
    </div>
</div>

@forelse ($pembayaran as $item)
<div class="card shadow-sm mb-3">
    <div class="card-body">
        <div class="row align-items-center">

            <div class="col-md-4">
                <h5 class="fw-bold mb-1">
                    {{ $item->tagihan->pelanggan->user->name }}
                </h5>
                <small class="text-muted">
                    {{ $item->tagihan->pelanggan->user->phone }}
                </small>
                <p class="mb-1">Tagihan: {{ $item->tagihan->bulan }}</p>
                <p class="fw-bold text-success">
                    Rp {{ number_format($item->tagihan->jumlah, 0, ',', '.') }}
                </p>
                <small class="text-muted">
                    {{ $item->created_at->translatedFormat('d F Y') }}
                </small>
            </div>

            <div class="col-md-4 text-center">
                <span class="badge bg-warning text-dark">
                    MENUNGGU KONFIRMASI
                </span>
                <p class="mt-2">Metode: {{ strtoupper($item->method) }}</p>
            </div>

            <div class="col-md-4 text-end">
                {{-- TERIMA --}}
                <form method="POST"
                      action="{{ route('admin.confirmations.accept', $item->id) }}"
                      class="d-inline">
                    @csrf
                    <button class="btn btn-success fw-bold">
                        Terima
                    </button>
                </form>

                {{-- TOLAK --}}
                <button class="btn btn-danger fw-bold"
                        data-bs-toggle="modal"
                        data-bs-target="#rejectModal{{ $item->id }}">
                    Tolak
                </button>
            </div>

        </div>
    </div>
</div>

{{-- MODAL TOLAK --}}
<div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST"
              action="{{ route('admin.confirmations.reject', $item->id) }}"
              class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pembayaran</h5>
            </div>
            <div class="modal-body">
                <textarea name="catatan_admin"
                          class="form-control"
                          required
                          placeholder="Alasan penolakan"></textarea>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

@empty
<div class="alert alert-light text-center">
    Tidak ada pembayaran yang menunggu konfirmasi
</div>
@endforelse

@endsection