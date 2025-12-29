<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagihanUserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user->pelanggan) {
            return response()->json([]);
        }

        return $user->pelanggan
            ->tagihans()
            ->orderBy('deadline', 'desc')
            ->get();
    }
}
