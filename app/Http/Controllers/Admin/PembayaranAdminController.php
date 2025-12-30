<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

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
            'alasan' => 'nullable|string|max:255'
        ]);

        $pembayaran = Pembayaran::with('tagihan')->findOrFail($id);

        $pembayaran->status = 'rejected';
        $pembayaran->catatan_admin = $request->alasan;
        $pembayaran->save();

        // Kembalikan status tagihan ke unpaid
        $pembayaran->tagihan->status = 'unpaid';
        $pembayaran->tagihan->save();

        return response()->json([
            'message' => 'Pembayaran ditolak'
        ]);
    }

}
