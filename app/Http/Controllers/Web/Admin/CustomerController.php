<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Pelanggan::with([
            'user',
            'tagihans.pembayarans' // ← WAJIB plural
        ])->orderBy('created_at', 'desc')->get();

        return view('admin.customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'phone' => 'required|unique:users,phone'
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'  => $request->name,
                'phone' => $request->phone,
                'role'  => 'customer',
            ]);

            Pelanggan::create([
                'user_id' => $user->id,
                'status'  => 'active'
            ]);
        });

        return back()->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'name'  => 'required|string',
            'phone' => 'required|unique:users,phone,' . $pelanggan->user_id
        ]);

        $pelanggan->user->update([
            'name'  => $request->name,
            'phone' => $request->phone
        ]);

        return back()->with('success', 'Data pelanggan diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        DB::transaction(function () use ($pelanggan) {
            $pelanggan->user->delete();
            $pelanggan->delete();
        });

        return back()->with('success', 'Pelanggan dihapus');
    }
}