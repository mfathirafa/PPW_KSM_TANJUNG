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

                    {{-- BACK --}}
                    <a href="{{ url('/login') }}"
                       class="position-absolute top-0 start-0 m-3 text-dark">
                        <i class="fas fa-arrow-left"></i>
                    </a>

                    <h1 class="h2 fw-bold">Verification Code</h1>
                    <p class="text-muted mb-4">
                        Please enter the 6-digit code sent to your<br>
                        Phone number<br>
                        <strong>{{ request('phone') }}</strong>
                    </p>

                    {{-- FORM VERIFY OTP --}}
                    <form method="POST" action="{{ route('otp.verify.user') }}" id="verifyForm">
                        @csrf

                        {{-- PHONE --}}
                        <input type="hidden" name="phone" value="{{ request('phone') }}">

                        {{-- OTP INPUT --}}
                        <div class="d-flex justify-content-center mb-4 gap-2">
                            <input type="text" class="form-control otp-input text-center" maxlength="1" inputmode="numeric">
                            <input type="text" class="form-control otp-input text-center" maxlength="1" inputmode="numeric">
                            <input type="text" class="form-control otp-input text-center" maxlength="1" inputmode="numeric">
                            <input type="text" class="form-control otp-input text-center" maxlength="1" inputmode="numeric">
                            <input type="text" class="form-control otp-input text-center" maxlength="1" inputmode="numeric">
                            <input type="text" class="form-control otp-input text-center" maxlength="1" inputmode="numeric">
                        </div>

                        {{-- REAL OTP --}}
                        <input type="hidden" name="otp" id="otp-value">

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-custom-green btn-lg fw-bold">
                                Verify
                            </button>
                        </div>
                    </form>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- TIMER --}}
                    <div class="text-center text-muted mt-3">
                        <span id="timer-text">
                            Request a new code in
                            <span id="countdown" class="fw-bold">00:30</span>
                        </span>
                        <a href="{{ url('/login/customer/whatsapp') }}"
                           id="resend-link"
                           class="fw-bold text-decoration-none"
                           style="display:none;">
                            Resend Again
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
/* ================= OTP INPUT UX ================= */
$('.otp-input').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value && $(this).next('.otp-input').length) {
        $(this).next('.otp-input').focus();
    }
}).on('keydown', function (e) {
    if (e.key === 'Backspace' && !this.value) {
        $(this).prev('.otp-input').focus();
    }
});

/* ================= VALIDATE & MERGE OTP ================= */
document.getElementById('verifyForm').addEventListener('submit', function (e) {
    let otp = '';
    document.querySelectorAll('.otp-input').forEach(i => otp += i.value);

    if (!/^\d{6}$/.test(otp)) {
        e.preventDefault();
        alert('OTP harus 6 digit angka');
        return;
    }

    document.getElementById('otp-value').value = otp;
});

/* ================= TIMER ================= */
let time = 30;
const countdown = document.getElementById('countdown');
const timerText = document.getElementById('timer-text');
const resendLink = document.getElementById('resend-link');

const interval = setInterval(() => {
    time--;
    countdown.textContent = '00:' + (time < 10 ? '0' : '') + time;

    if (time <= 0) {
        clearInterval(interval);
        timerText.style.display = 'none';
        resendLink.style.display = 'inline';
    }
}, 1000);
</script>

</body>
</html>