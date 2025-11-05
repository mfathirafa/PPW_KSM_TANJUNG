<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/admin-auth.css'])
    
</head>
<body class="bg-custom-green">

    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-md-6 col-lg-5">
                
                <div class="card auth-card shadow-lg border-0">
                    <div class="card-body p-4 p-md-5">

                        <a href="{{ url('/admin/login') }}" class="back-button">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        
                        <div class="text-center mt-4">
                            <h1 class="h2 fw-bold">Get Started</h1>
                            <p class="text-muted">by creating a free account.</p>
                        </div>

                        <form action="#" method="POST" class="mt-4">
                            @csrf <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control form-control-lg" placeholder="Full name" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control form-control-lg" placeholder="Valid email" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control form-control-lg" placeholder="Phone number" required>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" id="password" class="form-control form-control-lg" placeholder="Strong password" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fas fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">
                                    By checking the box you agree to our <a href="#">Terms</a> and <a href="#">Conditions</a>.
                                </label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-custom-green btn-lg fw-bold">Next &gt;</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ketika ikon mata di-klik
            $('#togglePassword').on('click', function() {
                // Ambil input password
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                
                // Ambil ikonnya
                var toggleIcon = $('#toggleIcon');

                // Jika tipe input adalah 'password', ubah jadi 'text'
                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    // Ubah ikon mata menjadi mata-coret
                    toggleIcon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    // Jika tipe input adalah 'text', ubah kembali jadi 'password'
                    passwordField.attr('type', 'password');
                    // Ubah ikon kembali menjadi mata
                    toggleIcon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });
    </script>
</body>
</html>