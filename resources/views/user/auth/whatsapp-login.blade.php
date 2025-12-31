<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Customer | KSM Tanjung</title>

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

                    {{-- BACK KE ROLE PICKER --}}
                    <a href="{{ url('/login') }}"
                       class="position-absolute top-0 start-0 m-3 text-dark">
                        <i class="fas fa-arrow-left"></i>
                    </a>

                    <i class="fab fa-whatsapp fa-3x text-success mt-4 mb-3"></i>

                    <h1 class="h4 fw-bold">Login Customer</h1>
                    <p class="text-muted mb-4">
                        Masuk menggunakan nomor WhatsApp Anda
                    </p>

                    {{-- FORM KIRIM OTP --}}
                    <form method="POST" action="/whatsapp/send-otp">
                        @csrf

                        {{-- 🔒 FIX: HARUS "type", BUKAN "role" --}}
                        <input type="hidden" name="role" value="customer">

                        <div class="input-group mb-3">
                            <span class="input-group-text">+62</span>
                            <input
                                type="tel"
                                name="phone"
                                class="form-control form-control-lg"
                                placeholder="812xxxxxxxx"
                                required
                                autofocus>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit"
                                    class="btn btn-custom-green btn-lg fw-bold">
                                Kirim Kode OTP
                            </button>
                        </div>
                    </form>

                    <small class="text-muted">
                        Kode OTP akan dikirim melalui WhatsApp
                    </small>

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    {{-- DEMO ONLY --}}
                    @if(session('otp_demo'))
                        <div class="alert alert-warning mt-3">
                            OTP (Demo): <strong>{{ session('otp_demo') }}</strong>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>