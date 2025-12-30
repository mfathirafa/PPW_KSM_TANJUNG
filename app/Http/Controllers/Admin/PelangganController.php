<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:pelanggans,user_id',
            'alamat'  => 'required|string',
        ]);

        $pelanggan = Pelanggan::create([
            'user_id' => $request->user_id,
            'alamat'  => $request->alamat,
        ]);

        return response()->json([
            'message' => 'Pelanggan berhasil dibuat',
            'data'    => $pelanggan
        ], 201);
    }
}
