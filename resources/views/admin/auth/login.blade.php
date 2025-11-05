<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/admin-auth.css'])
</head>
<body class="login-v3-bg">

    <div class="container">
        <div class="row align-items-center justify-content-center" style="min-height: 100vh;">
            
            <div class="col-lg-5 col-md-6">
                <div class="login-v3-left-panel">
                    <img src="{{ asset('assets/images/logoKSM.png') }}" alt="Logo KSM Tanjung" class="logo" style="width: 150px;">
                    
                    <h1 class="fw-bold">Selamat Datang di KSM Tanjung APPS</h1>
                </div>
            </div>
            
            <div class="col-lg-5 col-md-6">
                <div class="login-v3-right-panel">
                    <form>
                        <div class="login-input-group">
                            <i class="fas fa-user"></i>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        
                        <a href="#" class="btn btn-light w-100 text-start d-flex align-items-center" style="border-radius: 50px; padding: 0.75rem 1.25rem;">
                            <i class="fab fa-whatsapp fa-lg me-2 text-success"></i>
                            <span>Continue With WhatsApp</span>
                        </a>

                        <div class="d-flex justify-content-around my-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="rolePelanggan" value="pelanggan" checked>
                                <label class="form-check-label" for="rolePelanggan">
                                    Pelanggan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="roleAdmin" value="admin">
                                <label class="form-check-label" for="roleAdmin">
                                    Admin
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <a href="{{ url('admin/register') }}" class="btn btn-light-green">Belum Punya akun</a>
                            <button type="submit" class="btn btn-light-green">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>