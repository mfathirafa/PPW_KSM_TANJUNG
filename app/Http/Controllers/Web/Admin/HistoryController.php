<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class HistoryController extends Controller
{
    public function index()
    {
        // ADMIN: ambil SEMUA pembayaran yang SUDAH DITERIMA
        $riwayat = Pembayaran::with([
                'tagihan',
                'tagihan.pelanggan',
                'tagihan.pelanggan.user'
            ])
            ->where('status', 'accepted')
            ->latest()
            ->get();

        return view('admin.history.index', compact('riwayat'));
    }
}