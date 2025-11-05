<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login dengan WhatsApp</title>

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

                        <a href="{{ url('/admin/login') }}" class="back-button">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        
                        <i class="fab fa-whatsapp fa-3x text-success mt-4 mb-3"></i>

                        <h1 class="h2 fw-bold">Login dengan WhatsApp</h1>
                        <p class="text-muted mb-4">Masuk Menggunakan Nomor WhatsApp Anda</p>

                        <form action="#" method="POST">
                            @csrf <div class="input-group mb-3">
                                <span class="input-group-text">+62</span>
                                <input type="tel" class="form-control form-control-lg" placeholder="Masukkan Nomor WhatsApp Anda" required>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-custom-green btn-lg fw-bold">Kirim Kode Verifikasi</button>
                            </div>

                            <div class="info-box text-muted mb-4">
                                <i class="fas fa-info-circle"></i>
                                <span>Kami akan mengirimkan Kode Verifikasi melalui WhatsApp ke nomor yang anda masukkan.</span>
                            </div>

                            <div class="text-center text-muted" style="font-size: 0.8rem;">
                                Dengan melanjutkan, Anda menyetujui<br>
                                <a href="#" class="text-danger text-decoration-none fw-bold">Syarat & Ketentuan</a> serta <a href="#" class="text-danger text-decoration-none fw-bold">Kebijakan Privasi</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>