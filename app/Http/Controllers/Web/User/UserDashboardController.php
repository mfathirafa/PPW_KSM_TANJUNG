<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Notifikasi;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $tagihanAktif = Tagihan::whereHas('pelanggan', fn ($q) =>
            $q->where('user_id', $user->id)
        )->where('status', 'unpaid')->first();

        $notifikasi = Notifikasi::where('user_id', $user->id)
            ->latest()->take(5)->get();

        return view('user.dashboard', compact(
            'user',
            'tagihanAktif',
            'notifikasi'
        ));
    }

    public function bills()
    {
        $user = Auth::user();

        $tagihans = Tagihan::whereHas('pelanggan', fn ($q) =>
            $q->where('user_id', $user->id)
        )->latest()->get();

        return view('user.bills.index', compact('tagihans'));
    }

    public function history()
    {
        $user = Auth::user();

        $riwayat = Pembayaran::with('tagihan')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('user.history.index', compact('riwayat'));
    }

    public function profile()
    {
        return view('user.profile.index', [
            'user' => Auth::user()
        ]);
    }
}
