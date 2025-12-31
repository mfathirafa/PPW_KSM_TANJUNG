<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Otp;

class OtpWebController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SEND OTP (CUSTOMER & ADMIN)
    |--------------------------------------------------------------------------
    */
    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'role'  => 'required|in:customer,admin',
        ]);

        // 🔑 NORMALISASI NOMOR (WAJIB)
        $phone = preg_replace('/^0/', '62', $request->phone);

        // GENERATE OTP
        $otpCode = rand(100000, 999999);

        // SIMPAN / UPDATE OTP
        Otp::updateOrCreate(
            ['phone' => $phone],
            [
                'code'       => $otpCode,
                'expired_at' => now()->addMinutes(5),
                'is_used'    => 0,
            ]
        );

        // ⚠️ DEMO ONLY (hapus kalau WA gateway aktif)
        session()->flash('otp_demo', $otpCode);

        // REDIRECT SESUAI ROLE
        if ($request->role === 'admin') {
            return redirect()->route('admin.verify', ['phone' => $phone]);
        }

        return redirect()->route('user.verify', ['phone' => $phone]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW VERIFY PAGE - CUSTOMER
    |--------------------------------------------------------------------------
    */
    public function showUserVerify(Request $request)
    {
        abort_if(!$request->phone, 404);

        return view('user.auth.verify-code', [
            'phone' => $request->phone,
            'role'  => 'customer',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW VERIFY PAGE - ADMIN
    |--------------------------------------------------------------------------
    */
    public function showAdminVerify(Request $request)
    {
        abort_if(!$request->phone, 404);

        return view('admin.auth.verify-code', [
            'phone' => $request->phone,
            'role'  => 'admin',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY OTP - CUSTOMER
    |--------------------------------------------------------------------------
    */
    public function verifyUserOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp'   => 'required|digits:6',
        ]);

        // 🔑 NORMALISASI ULANG (KRITIS)
        $phone = preg_replace('/^0/', '62', $request->phone);

        $otp = Otp::where('phone', $phone)
            ->where('code', $request->otp)
            ->where('expired_at', '>', now())
            ->where('is_used', 0)
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa'
            ]);
        }

        $user = User::where('phone', $phone)
            ->where('role', 'customer')
            ->first();

        if (!$user) {
            return back()->withErrors([
                'otp' => 'Customer tidak terdaftar'
            ]);
        }

        Auth::login($user);
        $otp->update(['is_used' => 1]);

        return redirect('/dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY OTP - ADMIN
    |--------------------------------------------------------------------------
    */
    public function verifyAdminOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp'   => 'required|digits:6',
        ]);

        // 🔑 NORMALISASI ULANG
        $phone = preg_replace('/^0/', '62', $request->phone);

        $otp = Otp::where('phone', $phone)
            ->where('code', $request->otp)
            ->where('expired_at', '>', now())
            ->where('is_used', 0)
            ->latest()
            ->first();

        if (!$otp) {
            return back()->withErrors([
                'otp' => 'Kode OTP tidak valid atau sudah kadaluarsa'
            ]);
        }

        $admin = User::where('phone', $phone)
            ->where('role', 'admin')
            ->first();

        if (!$admin) {
            return back()->withErrors([
                'otp' => 'Admin tidak terdaftar'
            ]);
        }

        Auth::login($admin);
        $otp->update(['is_used' => 1]);

        return redirect('/admin/dashboard');
    }
}