<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UserHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $riwayat = Pembayaran::with('tagihan')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('user.history.index', compact('riwayat'));
    }

    public function invoice(Pembayaran $pembayaran)
    {
        if ($pembayaran->user_id !== Auth::id()) {
            abort(403);
        }

        return Pdf::loadView('user.history.invoice', [
            'pembayaran' => $pembayaran
        ])->download('invoice_' . $pembayaran->id . '.pdf');
    }
}