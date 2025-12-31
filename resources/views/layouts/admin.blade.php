<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoKSM.png') }}">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- CSS ADMIN --}}
    @vite(['resources/css/admin-app.css'])

    {{-- CHART.JS (GLOBAL, AMAN) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="d-flex">

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="sidebar collapsed">
        <div class="sidebar-header text-center py-3">
            <a href="{{ url('admin/dashboard') }}">
                <img src="{{ asset('assets/images/logoKSM-removebg.png') }}"
                     alt="Logo Sidebar"
                     class="sidebar-logo">
            </a>
        </div>

        <nav class="sidebar-nav">
            <ul class="list-unstyled">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                       class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/customers') }}"
                       class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
                        <i class="fas fa-users fa-fw me-3"></i>
                        <span>Kelola Pelanggan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/history') }}"
                       class="nav-link {{ request()->is('admin/history*') ? 'active' : '' }}">
                        <i class="fas fa-history fa-fw me-3"></i>
                        <span>Riwayat Pembayaran</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/confirmations') }}"
                       class="nav-link {{ request()->is('admin/confirmations*') ? 'active' : '' }}">
                        <i class="fas fa-check-to-slot fa-fw me-3"></i>
                        <span>Konfirmasi Tagihan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/reports/finance') }}"
                       class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
                        <i class="fas fa-chart-pie fa-fw me-3"></i>
                        <span>Laporan Keuangan</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/settings') }}"
                       class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <i class="fas fa-cog fa-fw me-3"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <div id="main-content" class="main-content flex-grow-1 expanded">

        {{-- HEADER --}}
        <header class="main-header d-flex justify-content-between align-items-center p-3">
            <div class="header-left d-flex align-items-center">
                <i id="sidebar-toggle"
                   class="fas fa-bars fa-2x me-4 d-none d-md-block sidebar-toggle-btn"></i>

                <div>
                    <h4 class="fw-bold mb-0">KSM TANJUNG</h4>
                    <small class="text-muted">Selamat datang, Admin!</small>
                </div>
            </div>

            <div class="header-right text-end">
                <button type="button"
                        class="btn btn-outline-dark fw-bold"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutModal">
                    Keluar <i class="fas fa-sign-out-alt ms-2"></i>
                </button>

                <div class="mt-1 text-muted">
                    <small>{{ now()->translatedFormat('l, d F Y') }}</small>
                </div>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="p-4">
            @yield('content')
        </main>
    </div>
</div>

{{-- LOGOUT MODAL --}}
<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0 rounded-4">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4 pt-0">
                <h4 class="fw-bold">Apakah Anda yakin ingin keluar?</h4>
                <p class="text-muted">
                    Akun Anda akan keluar dan kembali ke halaman login.
                </p>

                <div class="d-grid gap-2 mt-4">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS CORE --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function () {
        $('#sidebar-toggle').on('click', function () {
            $('#sidebar').toggleClass('collapsed');
            $('#main-content').toggleClass('expanded');
        });
    });
</script>

{{-- 🔥 WAJIB: SCRIPT DARI @push('scripts') MASUK DI SINI --}}
@stack('scripts')

</body>
</html>