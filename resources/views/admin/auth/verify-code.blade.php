<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Code</title>

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
                            Phone number <span class="phone-number">085156725521</span> for verification.
                        </p>

                        <form action="#" method="POST">
                            @csrf <div class="d-flex justify-content-center mb-4">
                                <input type="number" class="form-control otp-input" maxlength="1" required>
                                <input type="number" class="form-control otp-input" maxlength="1" required>
                                <input type="number" class="form-control otp-input" maxlength="1" required>
                                <input type="number" class="form-control otp-input" maxlength="1" required>
                                <input type="number" class="form-control otp-input" maxlength="1" required>
                                <input type="number" class="form-control otp-input" maxlength="1" required>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-custom-green btn-lg fw-bold">Verify</button>
                            </div>
                        </form>

                        <div class="text-center text-muted">
                            <span>Didn't receive any code? </span>
                            <a href="#" id="resend-link" class="fw-bold text-decoration-none" style="display: none;">Resend Again</a>
                            <span id="timer-text">Request a new code in <span id="countdown" class="fw-bold">00:30s</span></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // --- Fungsionalitas Input OTP ---
            $('.otp-input').on('keyup', function(e) {
                // Jika user mengetik angka, pindah ke input berikutnya
                if ($(this).val().length === 1) {
                    $(this).next('.otp-input').focus();
                }
                
                // Jika user menekan backspace di input yang kosong, pindah ke input sebelumnya
                if (e.key === "Backspace" && $(this).val().length === 0) {
                    $(this).prev('.otp-input').focus();
                }
            });

            // --- Fungsionalitas Countdown Timer ---
            function startTimer(duration, display) {
                var timer = duration, minutes, seconds;
                var interval = setInterval(function () {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.text(minutes + ":" + seconds + "s");

                    if (--timer < 0) {
                        clearInterval(interval);
                        $('#timer-text').hide();
                        $('#resend-link').show();
                    }
                }, 1000);
            }

            // Mulai timer saat halaman dimuat
            var thirtySeconds = 30,
                display = $('#countdown');
            startTimer(thirtySeconds, display);

            // Jika link 'Resend' di-klik (contoh)
            $('#resend-link').on('click', function(e) {
                e.preventDefault(); // Mencegah link berpindah halaman
                $(this).hide();
                $('#timer-text').show();
                startTimer(thirtySeconds, display);
                // Di sini nanti temanmu (backend) bisa menambahkan logika untuk mengirim ulang kode
            });
        });
    </script>
</body>
</html>