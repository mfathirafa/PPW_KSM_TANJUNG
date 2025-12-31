<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Otp;

class OtpWebController extends Controller
{
    /* =========================================================
     |  HELPER: NORMALISASI NOMOR (WAJIB 62xxxx)
     ========================================================= */
    private function normalizePhone(string $phone): string
    {
        // hapus selain angka
        $phone = preg_replace('/\D/', '', $phone);

        // 0812xxxx -> 62812xxxx
        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        // sudah 62xxxx
        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        // fallback
        return '62' . $phone;
    }

    /* =========================================================
     |  SEND OTP (CUSTOMER & ADMIN)
     ========================================================= */
    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'role'  => 'required|in:customer,admin',
        ]);

        $phone = $this->normalizePhone($request->phone);
        $otpCode = random_int(100000, 999999);

        // satu nomor = satu OTP aktif
        Otp::updateOrCreate(
            ['phone' => $phone],
            [
                'code'       => $otpCode,
                'expires_at' => now()->addMinutes(5),
                'is_used'    => 0,
            ]
        );

        // DEMO ONLY
        session()->flash('otp_demo', $otpCode);

        if ($request->role === 'admin') {
            return redirect()->route('admin.verify', ['phone' => $phone]);
        }

        return redirect()->route('user.verify', ['phone' => $phone]);
    }

    /* =========================================================
     |  SHOW VERIFY PAGE - CUSTOMER
     ========================================================= */
    public function showUserVerify(Request $request)
    {
        abort_if(!$request->phone, 404);

        return view('user.auth.verify-code', [
            'phone' => $request->phone,
        ]);
    }

    /* =========================================================
     |  SHOW VERIFY PAGE - ADMIN
     ========================================================= */
    public function showAdminVerify(Request $request)
    {
        abort_if(!$request->phone, 404);

        return view('admin.auth.verify-code', [
            'phone' => $request->phone,
        ]);
    }

    /* =========================================================
     |  VERIFY OTP - CUSTOMER
     ========================================================= */
    public function verifyUserOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp'   => 'required|digits:6',
        ]);

        $phone = $this->normalizePhone($request->phone);

        $otp = Otp::where('phone', $phone)
            ->where('code', $request->otp)
            ->where('is_used', 0)
            ->where('expires_at', '>', now())
            ->orderByDesc('id')
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa',
            ]);
        }

        $user = User::where('phone', $phone)
            ->where('role', 'customer')
            ->first();

        if (!$user) {
            return back()->withErrors([
                'otp' => 'User customer tidak ditemukan',
            ]);
        }

        Auth::guard('web')->login($user);
        $otp->update(['is_used' => 1]);

        return redirect('/dashboard');
    }

    /* =========================================================
     |  VERIFY OTP - ADMIN
     ========================================================= */
    public function verifyAdminOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp'   => 'required|digits:6',
        ]);

        $phone = $this->normalizePhone($request->phone);

        $otp = Otp::where('phone', $phone)
            ->where('code', $request->otp)
            ->where('is_used', 0)
            ->where('expires_at', '>', now())
            ->orderByDesc('id')
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa',
            ]);
        }

        $admin = User::where('phone', $phone)
            ->where('role', 'admin')
            ->first();

        if (!$admin) {
            return back()->withErrors([
                'otp' => 'Admin tidak ditemukan',
            ]);
        }

        Auth::guard('web')->login($admin);
        $otp->update(['is_used' => 1]);

        return redirect('/admin/dashboard');
    }
}