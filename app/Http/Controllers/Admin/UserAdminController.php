<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;


class UserAdminController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => User::with(['pelanggan'])->get()
        ]);
    }
}
