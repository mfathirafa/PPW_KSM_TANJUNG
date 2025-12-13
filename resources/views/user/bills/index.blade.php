@extends('layouts.user')

@section('title', 'Cek Tagihan')

@section('content')

<div id="view-bill-list">
    <div class="mb-4">
        <a href="{{ url('/dashboard') }}" class="text-decoration-none text-dark fw-bold fs-5">
            <i class="fas fa-chevron-left me-2"></i> Cek Tagihan
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bill-card-neon">
                <div class="bill-title-pill">Tagihan Bulan Ini</div>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="input-group bill-input-row">
                            <span class="input-group-text">No. Tagihan</span>
                            <input type="text" class="form-control" value="#12345" readonly>
                        </div>
                        <div class="input-group bill-input-row">
                            <span class="input-group-text">Bulan</span>
                            <input type="text" class="form-control" value="April 2025" readonly>
                        </div>
                        <div class="bill-input-row">
                            <span class="input-group-text" style="border-radius: 0.4rem 0 0 0.4rem;">Status</span>
                            <div class="status-badge">
                                <span class="bg-status-yellow">Belum Dibayar</span>
                            </div>
                        </div>
                        <div class="input-group bill-input-row">
                            <span class="input-group-text">Jumlah</span>
                            <input type="text" class="form-control" value="Rp.15.000" readonly>
                        </div>
                        <div class="input-group bill-input-row">
                            <span class="input-group-text">Deadline</span>
                            <input type="text" class="form-control" value="30 April 2025" readonly>
                        </div>
                        <button type="button" class="btn btn-pay-white btn-bayar-trigger">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="view-payment" class="d-none"> 
    <div class="mb-4">
        <a href="#" class="text-decoration-none text-dark fw-bold fs-5" id="btn-back-to-list">
            <i class="fas fa-chevron-left me-2"></i> Cek Tagihan
        </a>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="payment-details-card">
                <h5 class="fw-bold mb-4">Rincian Tagihan</h5>
                <div class="mb-3">
                    <div class="input-group bill-input-row">
                        <span class="input-group-text">No.Tagihan</span>
                        <input type="text" class="form-control" value="#12346" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group bill-input-row">
                        <span class="input-group-text">Bulan</span>
                        <input type="text" class="form-control" value="April 2025" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="input-group bill-input-row">
                        <span class="input-group-text">Jumlah</span>
                        <input type="text" class="form-control" value="Rp.15.000" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="payment-methods-card">
                <h5 class="fw-bold mb-4">Pilih Metode Pembayaran</h5>
                <form action="#" method="POST" id="payment-form">
                    <input type="radio" name="payment_method" id="qris" class="payment-option-input" value="Qris" checked>
                    <label for="qris" class="payment-option-label">
                        <div class="d-flex align-items-center">
                            <div class="payment-icon"><i class="fas fa-qrcode"></i></div>
                            <span>Qris</span>
                        </div>
                        <div class="custom-radio-circle"></div>
                    </label>

                    <input type="radio" name="payment_method" id="transfer" class="payment-option-input" value="Transfer Bank">
                    <label for="transfer" class="payment-option-label">
                        <div class="d-flex align-items-center">
                            <div class="payment-icon"><i class="fas fa-university"></i></div>
                            <span>Transfer bank</span>
                        </div>
                        <div class="custom-radio-circle"></div>
                    </label>

                    <input type="radio" name="payment_method" id="tunai" class="payment-option-input" value="Tunai">
                    <label for="tunai" class="payment-option-label">
                        <div class="d-flex align-items-center">
                            <div class="payment-icon"><i class="fas fa-money-bill-wave"></i></div>
                            <span>Tunai</span>
                        </div>
                        <div class="custom-radio-circle"></div>
                    </label>

                    <div class="mt-auto pt-4">
                        <div class="d-flex justify-content-between mb-3 fw-bold small">
                            <span>Jumlah yang dibayarkan</span>
                            <span>Rp. 15.000</span>
                        </div>
                        <button type="button" id="btn-show-confirm" class="btn btn-pay-dark w-100 py-2 fs-6">Bayar Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmationModal" class="custom-modal-overlay">
    <div class="custom-modal-box">
        <div class="custom-modal-header">
            <h3 style="font-size: 18px; font-weight: bold; margin:0;">Konfirmasi Transaksi</h3>
            <span class="custom-close-btn" id="btnCloseConfirm">&times;</span>
        </div>
        <p style="text-align: center; color: #666; font-size: 12px; margin-bottom: 20px;">
            Cek kembali rincian transaksi
        </p>

        <div class="custom-modal-body">
            <div class="data-row">
                <span class="data-label">Nama pelanggan</span>
                <span class="data-value">Fathi Setiawan</span>
            </div>
            <div class="data-row">
                <span class="data-label">No. Tagihan</span>
                <span class="data-value">#12346</span>
            </div>
            <div class="data-row">
                <span class="data-label">Bulan</span>
                <span class="data-value">April 2025</span>
            </div>
            <div class="data-row">
                <span class="data-label">Jumlah</span>
                <span class="data-value">Rp. 15.000</span>
            </div>
            
            <hr style="border-top: 1px dashed #ccc; margin: 15px 0;">

            <div class="data-row">
                <span class="data-label">Metode Pembayaran</span>
                <span class="data-value" id="modalMethodText">Qris</span>
            </div>
        </div>

        <button id="btnFinalPay" class="btn-confirm-green">Bayar Dengan Qris</button>
    </div>
</div>

<div id="modalQris" class="custom-modal-overlay">
    <div class="modal-box-wide">
        <span class="custom-close-btn" id="btnCloseQris">&times;</span>
        
        <div class="qris-header-title">Pembayaran Tagihan</div>

        <div class="qris-layout">
            <div class="qris-left">
                <p style="text-align: center; font-weight: bold; font-size: 12px; margin-bottom: 15px;">
                    Selesaikan Pembayaran Qris<br>Sebelum Waktu habis
                </p>
                <div class="timer-circle">
                    <span class="timer-time" id="countdownTimer">09:45</span>
                    <span class="timer-unit">Menit</span>
                </div>
                <div class="amount-box">
                    <span style="color:#555">Jumlah Tagihan</span>
                    <strong style="font-size: 16px;">Rp. 15.000</strong>
                </div>
            </div>

            <div class="qris-right">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QR Code" class="qr-image">
                
                <div class="qris-actions">
                    <button class="btn-qris-outline">
                        <i class="fas fa-share-alt"></i> Bagikan Qris
                    </button>
                    <button class="btn-qris-green">
                        <i class="fas fa-download"></i> Unduh Qris
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loadingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 rounded-4 p-4 text-center">
      <div class="modal-body">
        <div class="spinner-border text-dark mb-3" role="status" style="width: 3rem; height: 3rem; border-width: 4px;">
          <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="fw-bold mb-2">Menunggu Proses Pembayaran</h5>
        <p class="text-muted mb-0">Harap tunggu hingga transaksi selesai</p>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- VARIABLES ---
        const viewList = document.getElementById('view-bill-list');
        const viewPayment = document.getElementById('view-payment');
        const btnBack = document.getElementById('btn-back-to-list');
        const payButtons = document.querySelectorAll('.btn-bayar-trigger');
        const btnShowConfirm = document.getElementById('btn-show-confirm'); 
        
        // Modal Confirm
        const confirmModal = document.getElementById('confirmationModal');
        const btnCloseConfirm = document.getElementById('btnCloseConfirm');
        const btnFinalPay = document.getElementById('btnFinalPay');
        const modalMethodText = document.getElementById('modalMethodText');
        
        // Modal QRIS
        const modalQris = document.getElementById('modalQris');
        const btnCloseQris = document.getElementById('btnCloseQris');
        let timerInterval;

        // Modal Loading
        const loadingModalEl = document.getElementById('loadingModal');
        let loadingModal;
        if (window.bootstrap) {
            loadingModal = new bootstrap.Modal(loadingModalEl);
        }

        // --- NAVIGATION ---
        payButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                viewList.classList.add('d-none');
                viewPayment.classList.remove('d-none');
                window.scrollTo(0, 0);
            });
        });

        if (btnBack) {
            btnBack.addEventListener('click', function(e) {
                e.preventDefault();
                viewPayment.classList.add('d-none');
                viewList.classList.remove('d-none');
            });
        }

        // --- STEP 1: SHOW CONFIRMATION ---
        if (btnShowConfirm) {
            btnShowConfirm.addEventListener('click', function(e) {
                e.preventDefault();
                const selectedRadio = document.querySelector('input[name="payment_method"]:checked');
                
                if(selectedRadio) {
                    let methodName = selectedRadio.value ? selectedRadio.value : "Qris";
                    modalMethodText.innerText = methodName;
                    btnFinalPay.innerText = "Bayar Dengan " + methodName;
                }
                confirmModal.style.display = 'flex';
            });
        }

        // --- STEP 2: CLOSE CONFIRMATION ---
        if (btnCloseConfirm) {
            btnCloseConfirm.addEventListener('click', function() {
                confirmModal.style.display = 'none';
            });
        }

        // --- STEP 3: FINAL ACTION (QRIS OR OTHER) ---
        if (btnFinalPay) {
            btnFinalPay.addEventListener('click', function() {
                confirmModal.style.display = 'none';
                
                const methodText = btnFinalPay.innerText.toLowerCase();

                // JIKA QRIS -> BUKA MODAL QRIS & START TIMER
                if (methodText.includes('qris')) {
                    modalQris.style.display = 'flex';
                    const display = document.querySelector('#countdownTimer');
                    startTimer(585, display); // 9 menit 45 detik
                } 
                // JIKA BUKAN QRIS -> LOADING
                else {
                    if (loadingModal) loadingModal.show();
                    setTimeout(() => {
                        // Submit form or redirect here
                    }, 3000);
                }
            });
        }

        // --- QRIS MODAL LOGIC ---
        if (btnCloseQris) {
            btnCloseQris.addEventListener('click', function() {
                modalQris.style.display = 'none';
                clearInterval(timerInterval);
            });
        }

        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            clearInterval(timerInterval);
            
            timerInterval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                    clearInterval(timerInterval);
                    alert("Waktu Pembayaran Habis!");
                }
            }, 1000);
        }

        // Close on click outside
        window.onclick = function(event) {
            if (event.target == confirmModal) {
                confirmModal.style.display = 'none';
            }
            if (event.target == modalQris) {
                modalQris.style.display = 'none';
                clearInterval(timerInterval);
            }
        }
    });
</script>

@endsection