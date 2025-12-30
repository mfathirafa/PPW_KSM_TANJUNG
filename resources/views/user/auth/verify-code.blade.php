<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/admin-auth.css'])
</head>

<body class="bg-custom-green">

<div class="container">
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-md-6 col-lg-5">
            <div class="card auth-card shadow-lg border-0">
                <div class="card-body p-4 p-md-5 text-center">

                    <h1 class="h2 fw-bold">Verification Code</h1>
                    <p class="text-muted mb-4">
                        Please enter the 6-digit code sent to your<br>
                        Phone number
                        <span class="phone-number">
                            {{ request('phone') }}
                        </span>
                    </p>

                    <form id="verifyOtpForm">
                        <div class="d-flex justify-content-center mb-4">
                            <input type="number" class="form-control otp-input" maxlength="1" inputmode="numeric">
                            <input type="number" class="form-control otp-input" maxlength="1" inputmode="numeric">
                            <input type="number" class="form-control otp-input" maxlength="1" inputmode="numeric">
                            <input type="number" class="form-control otp-input" maxlength="1" inputmode="numeric">
                            <input type="number" class="form-control otp-input" maxlength="1" inputmode="numeric">
                            <input type="number" class="form-control otp-input" maxlength="1" inputmode="numeric">
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-custom-green btn-lg fw-bold">
                                Verify
                            </button>
                        </div>
                    </form>

                    <div class="text-center text-muted">
                        <span>Didn't receive any code? </span>
                        <a href="#" id="resend-link" class="fw-bold text-decoration-none" style="display:none;">
                            Resend Again
                        </a>
                        <span id="timer-text">
                            Request a new code in
                            <span id="countdown" class="fw-bold">00:30s</span>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* ================= OTP INPUT UX ================= */
$('.otp-input').on('input', function () {
    if (this.value.length === 1) {
        $(this).next('.otp-input').focus();
    }
}).on('keydown', function (e) {
    if (e.key === 'Backspace' && !this.value) {
        $(this).prev('.otp-input').focus();
    }
});

/* ================= TIMER ================= */
let time = 30;
const countdown = document.getElementById('countdown');
const timerText = document.getElementById('timer-text');
const resendLink = document.getElementById('resend-link');

const interval = setInterval(() => {
    time--;
    countdown.textContent = '00:' + (time < 10 ? '0' : '') + time + 's';

    if (time <= 0) {
        clearInterval(interval);
        timerText.style.display = 'none';
        resendLink.style.display = 'inline';
    }
}, 1000);

/* ================= VERIFY OTP ================= */
document.getElementById('verifyOtpForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    let otp = '';
    document.querySelectorAll('.otp-input').forEach(i => otp += i.value);

    if (!/^\d{6}$/.test(otp)) {
        alert('OTP harus 6 digit');
        return;
    }

    const phone = new URLSearchParams(window.location.search).get('phone');
    if (!phone) {
        alert('Nomor HP tidak ditemukan');
        return;
    }

    const res = await fetch('/whatsapp/verify-otp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ phone, otp })
    });

    const data = await res.json();

    if (!res.ok) {
        alert(data.message || 'OTP salah');
        return;
    }

    // 🔥 REDIRECT SESUAI ROLE (AMAN)
    if (data.role === 'admin') {
        window.location.href = '/admin/dashboard';
    } else {
        window.location.href = '/dashboard';
    }
});
</script>

</body>
</html>
