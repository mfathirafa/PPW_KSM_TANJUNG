<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        $tagihanBulanIni = Tagihan::whereMonth('created_at', now()->month)->count();

        $pemasukanHariIni = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->where('pembayarans.status', 'accepted')
            ->whereDate('pembayarans.created_at', today())
            ->sum('tagihans.jumlah');

        $menungguVerifikasi = Pembayaran::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalPelanggan',
            'tagihanBulanIni',
            'pemasukanHariIni',
            'menungguVerifikasi'
        ));
    }
}
