<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    //
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $code = rand(100000, 999999);

        // Simpan OTP
        Otp::create([
            'phone' => $request->phone,
            'code' => $code,
            'expires_at' => now()->addMinutes(5),
        ]);

        // TODO: kirim ke WhatsApp (sementara return JSON)

        return response()->json([
            'success' => true,
            'message' => 'OTP berhasil dibuat',
            'code' => $code, // sementara tampilkan untuk testing
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'code' => 'required'
        ]);

        $otp = Otp::where('phone', $request->phone)
                ->where('code', $request->code)
                ->where('is_used', false)
                ->first();

        if (!$otp) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP salah atau sudah dipakai'
            ], 400);
        }

        if ($otp->isExpired()) {
            return response()->json([
                'success' => false,
                'message' => 'Kode OTP sudah kedaluwarsa'
            ], 400);
        }

        // tandai sebagai digunakan
        $otp->update([
            'is_used' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'OTP valid'
        ]);
    }

}
