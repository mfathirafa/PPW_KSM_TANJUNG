<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalPemasukan = Pembayaran::where('pembayarans.status', 'accepted')
            ->join('tagihans', 'pembayarans.tagihan_id', '=', 'tagihans.id')
            ->sum('tagihans.jumlah');

        return response()->json([
            'total_pelanggan' => User::where('role', 'customer')->count(),

            'tagihan_bulan_ini' => Tagihan::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),

            'total_pemasukan' => $totalPemasukan,

            'pending_pembayaran' => Pembayaran::where('status', 'pending')->count(),

            'tagihan_terbaru' => Tagihan::with('pelanggan.user')
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
