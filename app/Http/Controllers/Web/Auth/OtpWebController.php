<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class OtpWebController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required|string'
        ]);

        $otpCode = rand(100000, 999999);

        User::firstOrCreate(
            ['phone' => $request->phone],
            ['role' => 'admin'] // atau customer tergantung halaman
        );

        Otp::create([
            'phone' => $request->phone,
            'code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(3),
        ]);

        // 🔥 PENTING: redirect ke halaman verifikasi
        return redirect('/admin/verify-code?phone=' . $request->phone);
    }


    public function verify(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'otp'   => 'required|digits:6',
        ]);

        $otp = Otp::where('phone', $request->phone)
            ->where('code', $request->otp)
            ->where('is_used', false)
            ->latest()
            ->first();

        if (!$otp || $otp->expires_at->isPast()) {
            return response()->json([
                'message' => 'OTP tidak valid'
            ], 422);
        }

        $user = User::where('phone', $request->phone)->firstOrFail();

        Auth::login($user);
        $otp->update(['is_used' => true]);

        return response()->json([
            'redirect' => $user->role === 'admin'
                ? '/admin/dashboard'
                : '/dashboard'
        ]);
    }
}
