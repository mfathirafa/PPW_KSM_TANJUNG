<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * SEND OTP
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:10'
        ]);

        $otpCode = rand(100000, 999999);

        // pastikan user ada
        $user = User::firstOrCreate(
            ['phone' => $request->phone],
            ['role' => 'customer']
        );

        // simpan OTP
        Otp::create([
            'phone' => $request->phone,
            'code' => $otpCode,
            'expires_at' => Carbon::now()->addMinutes(3)
        ]);

        return response()->json([
            'message' => 'OTP sent',
            'otp' => $otpCode, // PPW only
            'expires_in' => 180
        ]);
    }
    /**
     * VERIFY OTP
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'otp'   => 'required',
            'name'  => 'nullable|string|max:100'
        ]);

        $otp = Otp::where('phone', $request->phone)
            ->where('code', $request->otp)
            ->where('is_used', false)
            ->latest()
            ->first();

        if (!$otp || $otp->expires_at->isPast()) {
            return response()->json([
                'message' => 'Invalid or expired OTP'
            ], 401);
        }

        $user = User::where('phone', $request->phone)->first();

        if ($request->filled('name') && empty($user->name)) {
            $user->update(['name' => $request->name]);
        }

        $otp->update(['is_used' => true]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'role' => $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone
            ]
        ]);
    }


    /**
     * CURRENT USER
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'role' => $user->role
        ]);
    }

    /**
     * LOGOUT
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
