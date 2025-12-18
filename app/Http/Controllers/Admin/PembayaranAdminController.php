<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class PembayaranAdminController extends Controller
{
    // List pembayaran (untuk konfirmasi)
    public function index()
    {
        return Pembayaran::with(['tagihan.pelanggan.user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Terima pembayaran
    public function accept($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->status = 'accepted';
        $pembayaran->save();

        // Update status tagihan
        $pembayaran->tagihan->update([
            'status' => 'paid'
        ]);

        return response()->json([
            'message' => 'Pembayaran diterima'
        ]);
    }

    // Tolak pembayaran
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string'
        ]);

        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->status = 'rejected';
        $pembayaran->catatan_admin = $request->catatan;
        $pembayaran->save();

        return response()->json([
            'message' => 'Pembayaran ditolak'
        ]);
    }
}
