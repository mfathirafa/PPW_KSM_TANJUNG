<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $riwayat = Pembayaran::with([
                'tagihan'
            ])
            ->where('pembayarans.user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history.index', compact('riwayat'));
    }

    public function invoice(Pembayaran $pembayaran)
    {
        // SECURITY: pastikan invoice milik user
        if ($pembayaran->user_id !== Auth::id()) {
            abort(403);
        }

        $pdf = Pdf::loadView('user.history.invoice', [
            'pembayaran' => $pembayaran
        ])->setPaper('A4', 'portrait');

        return $pdf->download(
            'invoice_' . $pembayaran->id . '.pdf'
        );
    }
}