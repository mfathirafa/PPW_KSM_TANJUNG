<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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

        $otp = rand(100000, 999999);

        $user = User::firstOrCreate(
            ['phone' => $request->phone],
            [
                'role' => 'customer',
                'name' => null,
            ]
        );

        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(3);
        $user->save();

        // NOTE:
        // Di production → kirim via WhatsApp Gateway
        // Di PPW → tampilkan di response (boleh)

        return response()->json([
            'message' => 'OTP sent',
            'otp' => $otp,
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
            'otp'   => 'required'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (
            $user->otp !== $request->otp ||
            $user->otp_expires_at->isPast()
        ) {
            return response()->json(['message' => 'Invalid or expired OTP'], 401);
        }

        // OTP valid → login
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'token' => $token,
            'role' => $user->role,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'phone' => $user->phone,
            ]
        ]);
    }

    /**
     * CURRENT USER
     */
    public function me(Request $request)
    {
        return response()->json($request->user());
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
