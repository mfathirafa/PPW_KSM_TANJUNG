@extends('layouts.admin')

@section('title', 'Kelola Pelanggan - KSM Tanjung')

@section('content')

<div class="card shadow-sm page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4 class="fw-bold mb-0">Kelola Pelanggan</h4>
        </div>
        <div>
            <button type="button" class="btn btn-success fw-bold" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                <i class="fas fa-plus me-2"></i> Tambah Pelanggan
            </button>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
        <div class="flex-grow-1 me-3 mb-2 mb-md-0">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Cari Pelanggan...">
            </div>
        </div>
    </div>
</div>

@for ($i = 0; $i < 3; $i++)
<div class="customer-card">
    <div class="d-flex flex-wrap align-items-center">
        <div class="col-12 col-md-6 d-flex align-items-center mb-3 mb-md-0">
            <div class="avatar me-3"> <i class="fas fa-user"></i> </div>
            <div>
                <h5 class="fw-bold mb-0">Budi Santoso</h5>
                <small class="text-muted">+0859-7654-6789</small>
            </div>
        </div>
        <div class="col-12 col-md-4 mb-3 mb-md-0">
            <span class="badge rounded-pill status-badge">Aktif</span>
            <p class="mb-0 mt-2 text-muted">Pembayaran Terakhir : 25 September 2025</p>
        </div>
        <div class="col-12 col-md-2 d-flex justify-content-md-end">
            <button class="action-btn btn-history me-2" data-bs-toggle="modal" data-bs-target="#paymentHistoryModal"><i class="fas fa-history"></i></button>
            <button class="action-btn btn-edit me-2" data-bs-toggle="modal" data-bs-target="#editCustomerModal"><i class="fas fa-pencil-alt"></i></button>
            <button class="action-btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteCustomerModal"><i class="fas fa-trash"></i></button>
        </div>
    </div>
</div>
@endfor
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-add-customer">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold fs-3" id="addCustomerModalLabel">Tambah Pelanggan</h5>
      </div>
      <div class="modal-body px-4">
        <form>
          <div class="mb-3">
            <label for="customerName" class="form-label fw-bold">Nama Pelanggan</label>
            <input type="text" class="form-control" id="customerName" placeholder="Masukan nama pelanggan">
          </div>
          <div class="mb-3">
            <label for="customerWhatsapp" class="form-label fw-bold">Nomor Whatsapp</label>
            <input type="text" class="form-control" id="customerWhatsapp" placeholder="Masukan nomor Whatsapp">
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

<div class="modal fade" id="deleteCustomerModal" tabindex="-1" aria-labelledby="deleteCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow border-0 rounded-4">
      <div class="modal-body p-4 text-center">
        <div class="mb-3">
          <i class="fas fa-trash-alt fa-3x text-danger bg-light p-3 rounded-circle"></i>
        </div>
        <h4 class="fw-bold">Hapus Pelanggan</h4>
        <p class="text-muted">Apa anda yakin ingin menghapus pelanggan ini?</p>
        <div class="d-flex justify-content-center mt-4">
          <button type="button" class="btn btn-light fw-bold mx-2" data-bs-dismiss="modal" style="width: 120px;">Cancel</button>
          <button type="button" class="btn btn-danger fw-bold mx-2" style="width: 120px;">Hapus</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-add-customer">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold fs-3" id="editCustomerModalLabel">Edit Pelanggan</h5>
      </div>
      <div class="modal-body px-4">
        <form>
          <div class="mb-3">
            <label for="editCustomerName" class="form-label fw-bold">Nama Pelanggan</label>
            <input type="text" class="form-control" id="editCustomerName" value="Budi Santoso">
          </div>
          <div class="mb-3">
            <label for="editCustomerWhatsapp" class="form-label fw-bold">Nomor Whatsapp</label>
            <input type="text" class="form-control" id="editCustomerWhatsapp" value="+0859-7654-6789">
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center py-4">
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-simpan">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="paymentHistoryModal" tabindex="-1" aria-labelledby="paymentHistoryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow border-0 rounded-4">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold fs-4" id="paymentHistoryModalLabel">Riwayat Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="mb-4">
            <h5 class="fw-bold mb-0">Budi Santoso</h5>
            <small class="text-muted">+0859-7654-6789</small>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Bulan Pembayaran</th>
                        <th scope="col">Tanggal Bayar</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>September 2025</td>
                        <td>25 September 2025</td>
                        <td><span class="badge bg-lunas rounded-pill">Lunas</span></td>
                    </tr>
                    <tr>
                        <td>Agustus 2025</td>
                        <td>24 Agustus 2025</td>
                        <td><span class="badge bg-lunas rounded-pill">Lunas</span></td>
                    </tr>
                    <tr>
                        <td>Juli 2025</td>
                        <td>28 Juli 2025</td>
                        <td><span class="badge bg-lunas rounded-pill">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>


@endsection