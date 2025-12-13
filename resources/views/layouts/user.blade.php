<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KSM Tanjung')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoKSM.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/user-app.css'])
</head>

<body>

    <div class="user-wrapper">

        <header class="user-header">
            <img src="{{ asset('assets/images/logoKSM.png') }}" alt="Logo" class="logo">

            <nav class="user-nav d-none d-md-block">
                <a href="{{ url('/dashboard') }}" class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    Beranda
                </a>

                <a href="{{ url('/bills') }}" class="{{ Request::is('bills') ? 'active' : '' }}">
                    Tagihan
                </a>

                <a href="{{ url('/history') }}" class="{{ Request::is('history') ? 'active' : '' }}">
                    Riwayat
                </a>
            </nav>

            <a href="{{ url('/profile') }}" class="user-icon">
                <i class="fas fa-user-circle"></i>
            </a>
        </header>

        <main class="user-content">
            @yield('content')
        </main>

        <footer class="user-footer">
            <div>
                <img src="{{ asset('assets/images/logoKSM-removebg.png') }}" alt="Logo" class="logo">
                <p class="mb-0 mt-2 fw-bold">Tentang kami</p>
            </div>
            <div class="contact-info">
                <p>KSM Tanjung</p>
                <small>Desa Tanjung</small><br>
                <small>0865-0976-0565</small>
            </div>
        </footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>