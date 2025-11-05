<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/images/logoKSM.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/admin-app.css'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <div class="d-flex">
        <aside id="sidebar" class="sidebar collapsed">
            <div class="sidebar-header text-center py-3">
                <a href="{{ url('admin/dashboard') }}">
                    <img src="{{ asset('assets/images/logoKSM-removebg.png') }}" alt="Logo Sidebar" class="sidebar-logo">
                </a>
            </div>

            <nav class="sidebar-nav">
                <ul class="list-unstyled">
                    <li class="nav-item"> <a href="{{ url('admin/dashboard') }}" class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span></a> </li>
                    <li class="nav-item"> <a href="{{ url('admin/customers') }}" class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}"><i class="fas fa-users fa-fw me-3"></i><span>Kelola Pelanggan</span></a> </li>
                    <li class="nav-item"> <a href="{{ url('admin/history') }}" class="nav-link {{ request()->is('admin/history*') ? 'active' : '' }}"><i class="fas fa-history fa-fw me-3"></i><span>Riwayat Pembayaran</span></a> </li>
                    <li class="nav-item"> <a href="{{ url('admin/confirmations') }}" class="nav-link {{ request()->is('admin/confirmations*') ? 'active' : '' }}"><i class="fas fa-check-to-slot fa-fw me-3"></i><span>Konfirmasi Tagihan</span></a> </li>
                    <li class="nav-item"> <a href="{{ url('admin/reports/finance') }}" class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}"><i class="fas fa-chart-pie fa-fw me-3"></i><span>Laporan Keuangan</span></a> </li>
                    <li class="nav-item"> <a href="{{ url('admin/settings') }}" class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}"><i class="fas fa-cog fa-fw me-3"></i><span>Pengaturan</span></a> </li>
                </ul>
            </nav>
        </aside>

        <div id="main-content" class="main-content flex-grow-1 expanded">
            <header class="main-header d-flex justify-content-between align-items-center p-3">
                <div class="header-left d-flex align-items-center">
                    <i id="sidebar-toggle" class="fas fa-bars fa-2x me-4 d-none d-md-block sidebar-toggle-btn"></i>
                    <div>
                        <h4 class="fw-bold mb-0">KSM TANJUNG</h4>
                        <small class="text-muted">Selamat datang, Admin!</small>
                    </div>
                </div>
                <div class="header-right text-end">
                    <button type="button" class="btn btn-outline-dark fw-bold" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        Keluar <i class="fas fa-sign-out-alt ms-2"></i>
                    </button>
                    <div class="mt-1 text-muted">
                        <small>Rabu, 29 Oktober 2025</small>
                    </div>
                </div>
            </header>

            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0 rounded-4">
          <div class="modal-header border-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center p-4 pt-0">
            <h4 class="fw-bold" id="logoutModalLabel">Apakah Anda yakin ingin keluar?</h4>
            <p class="text-muted">Pastikan Anda telah menyelesaikan pembayaran dan menyimpan bukti pembayaran sebelum keluar.</p>
            <div class="d-grid gap-2 mt-4">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger">Keluar</button>
            </div>
            <small class="text-muted mt-3 d-block">Akun Anda akan keluar dan kembali ke halaman login.</small>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sidebar-toggle').on('click', function() {
                $('#sidebar').toggleClass('collapsed');
                $('#main-content').toggleClass('expanded');
            });
        });
    </script>
</body>
</html>