@extends('layouts.admin')

@section('title', 'Laporan Keuangan - KSM Tanjung')

@section('content')

<div class="text-center mb-4">
    <h3 class="fw-bold">Laporan Keuangan KSM Tanjung</h3>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card report-card border-success shadow-sm">
            <div class="card-body">
                <p class="text-muted mb-1">Total Pemasukan</p>
                <h4 class="fw-bold">Rp 1.500.000</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card report-card border-warning shadow-sm">
            <div class="card-body">
                <p class="text-muted mb-1">Total Pengeluaran</p>
                <h4 class="fw-bold">Rp 500.000</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card report-card border-danger shadow-sm">
            <div class="card-body">
                <p class="text-muted mb-1">Total Tagihan dibuat</p>
                <h4 class="fw-bold">30 Tagihan</h4>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header data-table-header text-center">
        <h5 class="mb-0 fw-bold">Grafik Pengeluaran dan Pemasukan</h5>
    </div>
    <div class="card-body chart-container">
        <canvas id="financeChart"></canvas>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body d-flex justify-content-center flex-wrap">
        <button type="button" class="btn btn-outline-secondary fw-bold m-2" data-bs-toggle="modal" data-bs-target="#downloadCsvModal">
            <i class="fas fa-download me-2"></i> Download CSV
        </button>
        <button type="button" class="btn btn-success fw-bold m-2" data-bs-toggle="modal" data-bs-target="#generatePdfModal">
            <i class="fas fa-file-pdf me-2"></i> Generate PDF Report
        </button>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header data-table-header">
        <h5 class="mb-0 fw-bold">Detail Laporan Bulanan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Saldo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Januari</td>
                        <td>Rp. 500.000</td>
                        <td>Rp. 750.000</td>
                        <td>Rp. 250.000</td>
                        <td><a href="#" class="btn btn-cetak">cetak <i class="fas fa-print"></i></a></td>
                    </tr>
                    <tr>
                        <td>Februari</td>
                        <td>Rp. 300.000</td>
                        <td>Rp. 250.000</td>
                        <td>Rp. 300.000</td>
                        <td><a href="#" class="btn btn-cetak">cetak <i class="fas fa-print"></i></a></td>
                    </tr>
                    <tr>
                        <td>Maret</td>
                        <td>Rp. 550.000</td>
                        <td>Rp. 50.000</td>
                        <td>Rp. 350.000</td>
                        <td><a href="#" class="btn btn-cetak">cetak <i class="fas fa-print"></i></a></td>
                    </tr>
                    <tr>
                        <td>April</td>
                        <td>Rp. 250.000</td>
                        <td>Rp. 100.000</td>
                        <td>Rp. 550.000</td>
                        <td><a href="#" class="btn btn-cetak">cetak <i class="fas fa-print"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="generatePdfModal" tabindex="-1" aria-labelledby="generatePdfModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-report-options">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold fs-4" id="generatePdfModalLabel">Generate PDF Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form>
          <div class="mb-3">
            <label for="reportTitle" class="form-label fw-bold">Report title</label>
            <input type="text" class="form-control" id="reportTitle" value="Financial report">
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Include section</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkMatric">
                <label class="form-check-label" for="checkMatric">Matrick Overview</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkCharts">
                <label class="form-check-label" for="checkCharts">Financial Charts</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="checkHistory">
                <label class="form-check-label" for="checkHistory">Transaction history</label>
            </div>
          </div>
          <div class="mb-3">
            <label for="additionalNotes" class="form-label fw-bold">Additional Notes</label>
            <textarea class="form-control" id="additionalNotes" rows="3" placeholder="Add any notes or comments to include in the report"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center py-3">
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-action">Buat PDF</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="downloadCsvModal" tabindex="-1" aria-labelledby="downloadCsvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-report-options">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-center fw-bold fs-4" id="downloadCsvModalLabel">Download CSV Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="text-center text-muted mb-4">Pilih rentang tanggal untuk laporan yang akan diunduh.</p>
        <form>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="startDate" class="form-label fw-bold">Tanggal Mulai</label>
              <input type="date" class="form-control" id="startDate">
            </div>
            <div class="col-md-6 mb-3">
              <label for="endDate" class="form-label fw-bold">Tanggal Selesai</label>
              <input type="date" class="form-control" id="endDate">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer border-0 d-flex justify-content-center py-3">
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-action">Download</button>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('financeChart').getContext('2d');
    const chartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [
            {
                label: 'Pemasukan',
                data: [400000, 300000, 450000, 300000, 500000, 480000, 490000, 420000, 510000, 480000, 520000, 490000],
                backgroundColor: '#34D399',
                borderColor: '#34D399',
                borderWidth: 1
            },
            {
                label: 'Pengeluaran',
                data: [500000, 200000, 350000, 150000, 300000, 400000, 250000, 300000, 200000, 310000, 280000, 350000],
                backgroundColor: '#FFD700',
                borderColor: '#FFD700',
                borderWidth: 1
            }
        ]
    };
    const financeChart = new Chart(ctx, {
        type: 'bar', data: chartData,
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true, ticks: { callback: function(value) { return 'Rp ' + new Intl.NumberFormat('id-ID').format(value); } } } },
            plugins: { legend: { position: 'top' }, tooltip: { callbacks: { label: function(context) { let label = context.dataset.label || ''; if (label) { label += ': '; } if (context.parsed.y !== null) { label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y); } return label; } } } }
        }
    });
});
</script>

@endsection