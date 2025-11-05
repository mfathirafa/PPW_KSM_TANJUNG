@extends('layouts.admin')

@section('title', 'Konfirmasi Tagihan - KSM Tanjung')

@section('content')

<div class="card shadow-sm page-header">
    <h4 class="fw-bold mb-0">Konfirmasi Tagihan</h4>
</div>

<div class="filter-box mb-4">
    <h5 class="fw-bold mb-3">Filter Pembayaran</h5>
    <form>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <label for="filterStatus" class="form-label">Status</label>
                <select id="filterStatus" class="form-select">
                    <option selected>Semua</option>
                    <option value="1">Menunggu Konfirmasi</option>
                    <option value="2">Diterima</option>
                    <option value="3">Ditolak</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-3">
                <label for="filterMethod" class="form-label">Metode Pembayaran</label>
                <select id="filterMethod" class="form-select">
                    <option selected>Semua</option>
                    <option value="1">Qris</option>
                    <option value="2">Transfer Bank</option>
                </select>
            </div>
            <div class="col-md-6 col-lg-3">
                <label for="filterDateFrom" class="form-label">Dari Tanggal</label>
                <input type="date" class="form-control" id="filterDateFrom">
            </div>
            <div class="col-md-6 col-lg-3">
                <label for="filterDateTo" class="form-label">Sampai Tanggal</label>
                <input type="date" class="form-control" id="filterDateTo">
            </div>
        </div>
    </form>
</div>

@for ($i = 0; $i < 2; $i++)
<div class="card shadow-sm confirmation-card mb-4">
    <div class="row gy-3">
        <div class="col-md-4">
            <h5 class="fw-bold mb-1">Agustinus Maharaja</h5>
            <p class="text-muted mb-2">0876-0932-3476</p>
            <p class="mb-1">Tagihan #78656</p>
            <h5 class="fw-bold text-success mb-1">Rp. 5.000</h5>
            <small class="text-muted">26 Oktober 2025</small>
        </div>
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-md-center">
            <div class="mb-3">
                <p class="text-muted mb-1">Status</p>
                <span class="badge rounded-pill status-badge">Menunggu Konfirmasi</span>
            </div>
            <div>
                <p class="text-muted mb-1">Metode Pembayaran</p>
                <span class="badge rounded-pill method-badge">Qris</span>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <button class="btn btn-action btn-terima mx-2" data-bs-toggle="modal" data-bs-target="#acceptModal">Terima</button>
            <button class="btn btn-action btn-tolak mx-2" data-bs-toggle="modal" data-bs-target="#rejectModal">Tolak</button>
        </div>
    </div>
</div>
@endfor
<div class="modal fade" id="acceptModal" tabindex="-1" aria-labelledby="acceptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-4">
      <div class="modal-body p-4 text-center">
        <div class="mb-3">
          <i class="fas fa-check-circle fa-3x text-success bg-light p-3 rounded-circle"></i>
        </div>
        <h4 class="fw-bold">Terima Pembayaran</h4>
        <p class="text-muted">Anda yakin ingin mengonfirmasi pembayaran untuk tagihan ini?</p>
        <div class="d-flex justify-content-center mt-4">
          <button type="button" class="btn btn-light fw-bold mx-2" data-bs-dismiss="modal" style="width: 120px;">Batal</button>
          <button type="button" class="btn btn-success fw-bold mx-2" style="width: 120px;">Ya, Terima</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-4">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold fs-4" id="rejectModalLabel">Tolak Pembayaran</h5>
      </div>
      <div class="modal-body p-4">
        <form>
          <div class="mb-3">
            <label for="rejectionReason" class="form-label"><strong>Alasan Penolakan</strong></label>
            <textarea class="form-control" id="rejectionReason" rows="3" placeholder="Contoh: Bukti pembayaran tidak valid..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center">
          <button type="button" class="btn btn-light fw-bold mx-2" data-bs-dismiss="modal" style="width: 120px;">Batal</button>
          <button type="button" class="btn btn-danger fw-bold mx-2" style="width: 120px;">Tolak</button>
      </div>
    </div>
  </div>
</div>


@endsection