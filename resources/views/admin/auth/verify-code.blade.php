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
                        Masukkan 6 digit kode verifikasi
                    </p>

                    {{-- FORM VERIFY --}}
                    <form method="POST" action="/whatsapp/verify-otp">
                        @csrf

                        {{-- phone WAJIB --}}
                        <input type="hidden" name="phone" value="{{ request('phone') }}">

                        <div class="d-flex justify-content-center mb-4">
                            <input
                                type="text"
                                name="otp"
                                class="form-control text-center"
                                maxlength="6"
                                style="width: 180px; letter-spacing: 8px;"
                                placeholder="••••••"
                                required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-custom-green btn-lg fw-bold">
                                Verify
                            </button>
                        </div>
                    </form>

                    @if ($errors->any())
                        <div class="text-danger mt-2">
                            {{ $errors->first() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>