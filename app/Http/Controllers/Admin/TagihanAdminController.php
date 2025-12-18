<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class TagihanAdminController extends Controller
{
    // List tagihan
    public function index()
    {
        return Tagihan::with('pelanggan.user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    // Buat tagihan baru
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'bulan'        => 'required',
            'jumlah'       => 'required|integer',
            'deadline'     => 'required|date',
        ]);

        $tagihan = Tagihan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'bulan'        => $request->bulan,
            'jumlah'       => $request->jumlah,
            'deadline'     => $request->deadline,
            'status'       => 'unpaid',
        ]);

        return response()->json([
            'message' => 'Tagihan berhasil dibuat',
            'data' => $tagihan
        ], 201);
    }
}

