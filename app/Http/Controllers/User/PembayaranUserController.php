<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;


class PembayaranUserController extends Controller
{
    // Upload pembayaran
    public function store(Request $request, Tagihan $tagihan)
    {
        $user = $request->user();

        // Pastikan tagihan milik user
        if ($tagihan->pelanggan->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Cegah bayar dua kali
        if ($tagihan->pembayaran) {
            return response()->json(['message' => 'Tagihan sudah dibayar'], 400);
        }

        $request->validate([
            'method' => 'required|in:qris,transfer',
            'bukti'  => 'required|file|image|max:2048',
        ]);

        $path = $request->file('bukti')->store('bukti', 'public');

        $pembayaran = Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'user_id'    => $user->id,
            'method'     => $request->method,
            'bukti'      => $path,
            'status'     => 'pending',
        ]);

        return response()->json([
            'message' => 'Pembayaran dikirim, menunggu konfirmasi',
            'data' => $pembayaran
        ], 201);
    }

    // Riwayat pembayaran
    public function riwayat(Request $request)
    {
        return Pembayaran::with('tagihan')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
    
}
