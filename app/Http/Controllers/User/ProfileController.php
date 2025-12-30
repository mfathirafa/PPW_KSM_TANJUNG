<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;

class ProfileController extends Controller
{
    /**
     * Ambil profil user yang sedang login
     */
    public function show()
    {
        $user = auth()->user();

        return response()->json([
            'user' => [
                'user_id' => $user->user_id,
                'nama'    => $user->nama,
                'email'   => $user->email,
                'role'    => $user->role,
            ],
            'pelanggan' => $user->pelanggan
        ]);
    }

    /**
     * Lengkapi / update profil user
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'no_hp'  => 'required|string|max:15',
        ]);

        $user = auth()->user();

        // Update nama user
        $user->update([
            'nama' => $request->nama,
        ]);

        // Update / create data pelanggan
        Pelanggan::updateOrCreate(
            ['user_id' => $user->user_id],
            [
                'nama'   => $request->nama,
                'alamat' => $request->alamat,
                'no_hp'  => $request->no_hp,
            ]
        );

        return response()->json([
            'message' => 'Profil berhasil diperbarui'
        ]);
    }
}
