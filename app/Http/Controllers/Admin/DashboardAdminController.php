<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Support\Carbon;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Total pelanggan
        $totalPelanggan = Pelanggan::count();

        // 2. Total tagihan bulan ini
        $totalTagihanBulanIni = Tagihan::whereMonth('created_at', $today->month)
            ->whereYear('created_at', $today->year)
            ->sum('jumlah');

        // 3. Pembayaran menunggu konfirmasi
        $menungguKonfirmasi = Pembayaran::where('status', 'pending')->count();

        // 4. Pembayaran hari ini (yang diterima)
        $pembayaranHariIni = Pembayaran::whereDate('created_at', $today)
            ->where('status', 'accepted')
            ->sum('tagihan.jumlah'); // akan kita handle manual di bawah

        // Karena sum relasi tidak langsung, kita hitung manual
        $pembayaranHariIni = Pembayaran::with('tagihan')
            ->whereDate('created_at', $today)
            ->where('status', 'accepted')
            ->get()
            ->sum(fn ($p) => $p->tagihan->jumlah);

        // 5. List tagihan terbaru (limit 5)
        $tagihanTerbaru = Tagihan::with('pelanggan.user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'total_pelanggan' => $totalPelanggan,
            'total_tagihan_bulan_ini' => $totalTagihanBulanIni,
            'menunggu_konfirmasi' => $menungguKonfirmasi,
            'pembayaran_hari_ini' => $pembayaranHariIni,
            'tagihan_terbaru' => $tagihanTerbaru,
        ]);
    }
}
