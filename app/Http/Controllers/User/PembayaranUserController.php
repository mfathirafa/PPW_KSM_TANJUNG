<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;



class PembayaranUserController extends Controller
{
    // Upload pembayaran
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'tagihan_id' => 'required|exists:tagihans,id',
            'method'     => 'required|string|in:qris,transfer,cash',
            'jumlah'     => 'required|integer',
            'bukti'      => 'nullable|image|max:2048',
        ]);

        $tagihan = Tagihan::with('pelanggan')->findOrFail($request->tagihan_id);

        if ($tagihan->pelanggan->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($tagihan->pembayaran) {
            return response()->json(['message' => 'Tagihan sudah dibayar'], 400);
        }

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti', 'public');
        }

        $pembayaran = Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'user_id'    => $user->id,
            'method'     => $request->method,
            'jumlah'     => $request->jumlah,
            'bukti'      => $path,
            'status'     => 'pending',
        ]);

        return response()->json([
            'message' => 'Pembayaran dikirim, menunggu konfirmasi',
            'data' => $pembayaran
        ], 201);
    }
    public function riwayat(Request $request)
    {
        return Pembayaran::with(['tagihan'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    
}
