<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Pelanggan;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Auth;


class UserDashboardController extends Controller
{
    /**
     * DASHBOARD
     */
    public function index()
        {
            $user = Auth::user();

            // 🔹 Tagihan aktif (belum dibayar)
            $tagihan = Tagihan::with('pelanggan')
                ->whereHas('pelanggan', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->where('status', 'unpaid')
                ->latest()
                ->first();

            // 🔹 Notifikasi user
            $notifikasis = Notifikasi::where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            return view('user.dashboard', compact(
                'user',
                'tagihan',
                'notifikasis'
            ));
        }

    /**
     * CEK TAGIHAN ( /bills )
     */
    public function bills()
    {
        $user = Auth::user();

        $tagihans = Tagihan::with('pelanggan')
            ->whereHas('pelanggan', fn ($q) => $q->where('user_id', $user->id))
            ->orderByDesc('created_at')
            ->get();

        return view('user.bills.index', compact('tagihans'));
    }

    /**
     * RIWAYAT PEMBAYARAN
     */
    
    public function history()
    {
        $user = Auth::user();

        $riwayat = Pembayaran::with(['tagihan'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history.index', compact('riwayat'));
    }



    /**
     * PROFIL
     */
    public function profile()
    {
        $user = Auth::user();

        return view('user.profile.index', compact('user'));
    }
}
