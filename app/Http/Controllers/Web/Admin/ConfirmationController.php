<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with([
                'tagihan.pelanggan.user'
            ])
            ->where('pembayarans.status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.confirmations.index', compact('pembayaran'));
    }

    public function accept(Pembayaran $pembayaran)
    {
        $pembayaran->update([
            'status' => 'accepted',
            'catatan_admin' => null,
        ]);

        // OPTIONAL (kalau tagihan punya kolom status)
        if ($pembayaran->tagihan) {
            $pembayaran->tagihan->update([
                'status' => 'paid'
            ]);
        }

        return back()->with('success', 'Pembayaran diterima');
    }

    public function reject(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:255'
        ]);

        $pembayaran->update([
            'status' => 'rejected',
            'catatan_admin' => $request->catatan_admin
        ]);

        return back()->with('success', 'Pembayaran ditolak');
    }
}