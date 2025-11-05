@extends('layouts.admin')

@section('title', 'Riwayat Pembayaran - KSM Tanjung')

@section('content')

<div class="card shadow-sm page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-0">Riwayat Pembayaran</h4>
        </div>
        <div>
            <button type="button" class="btn btn-new-bill" data-bs-toggle="modal" data-bs-target="#newBillModal">
                <i class="fas fa-plus me-2"></i> Tagihan Baru
            </button>
        </div>
    </div>
</div>

<div class="row">
    @for ($i = 0; $i < 4; $i++)
    <div class="col-lg-6">
        <div class="bill-card shadow-sm">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <span class="bill-id">#TAG-00123</span>
                    <h5 class="fw-bold mb-0">Fathi Setiawan</h5>
                    <p class="text-muted mb-2">+0876-0943-2312</p>
                    <small class="text-muted bill-due-date">Jatuh Tempo : 30 Oktober</small>
                </div>
                <div>
                    <span class="badge rounded-pill bg-success status-badge">Lunas</span>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <span class="text-success bill-amount fw-bold">Rp. 5.000</span>
                <div>
                    <button class="action-btn btn-edit me-2"><i class="fas fa-pencil-alt"></i></button>
                    <button class="action-btn btn-delete"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>

<div class="modal fade" id="newBillModal" tabindex="-1" aria-labelledby="newBillModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-add-customer">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold fs-3" id="newBillModalLabel">Buat Tagihan Baru</h5>
      </div>
      <div class="modal-body px-4">
        <form>
          <div class="mb-3">
            <label for="selectCustomer" class="form-label fw-bold">Pilih Pelanggan</label>
            <select class="form-select" id="selectCustomer" style="border-radius: 50px; padding: 0.75rem 1.25rem;">
                <option selected>-- Pilih nama pelanggan --</option>
                <option value="1">Budi Santoso</option>
                <option value="2">Fathi Setiawan</option>
                <option value="3">Agustinus Maharaja</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="billAmount" class="form-label fw-bold">Jumlah Tagihan</label>
            <div class="input-group">
                <span class="input-group-text" style="border-top-left-radius: 50px; border-bottom-left-radius: 50px;">Rp.</span>
                <input type="text" inputmode="numeric" class="form-control" id="billAmount" placeholder="Contoh: 5000" style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;">
            </div>
          </div>
          <div class="mb-3">
            <label for="dueDate" class="form-label fw-bold">Tanggal Jatuh Tempo</label>
            <input type="date" class="form-control" id="dueDate">
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center py-4">
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-simpan">Simpan</button>
      </div>
    </div>
  </div>
</div>

@endsection