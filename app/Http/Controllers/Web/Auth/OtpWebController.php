<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Otp;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OtpWebController extends Controller
{
    /**
     * KIRIM OTP (WEB)
     * Dipanggil dari form WhatsApp Login
     */
    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:10',
            'type'  => 'required|in:user,admin',
        ]);

        $otpCode = rand(100000, 999999);

        // 🔥 BUAT / AMBIL USER SESUAI ROLE
        $user = User::firstOrCreate(
            ['phone' => $request->phone],
            [
                'role' => $request->type === 'admin' ? 'admin' : 'customer',
            ]
        );

        // ❗ JANGAN IZINKAN CUSTOMER LOGIN VIA ADMIN
        if ($request->type === 'admin' && $user->role !== 'admin') {
            return back()->withErrors([
                'phone' => 'Nomor ini bukan akun admin',
            ]);
        }

        // Simpan OTP
        Otp::create([
            'phone'      => $request->phone,
            'code'       => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(3),
        ]);

        // 🔥 Redirect ke halaman verify SESUAI ROLE
        return redirect(
            $request->type === 'admin'
                ? '/admin/verify-code?phone=' . $request->phone
                : '/verify-code?phone=' . $request->phone
        )->with('otp_demo', $otpCode); // PPW ONLY
    }

    /**
     * VERIFY OTP (WEB)
     */
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
            return back()->withErrors(['otp' => 'OTP tidak valid atau kadaluarsa']);
        }

        $user = User::where('phone', $request->phone)->firstOrFail();

        // LOGIN SESSION WEB
        Auth::login($user);

        $otp->update(['is_used' => true]);

        // 🔥 REDIRECT BERDASARKAN ROLE
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        return redirect('/dashboard');
    }


}
