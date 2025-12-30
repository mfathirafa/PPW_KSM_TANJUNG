<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ReportAdminController extends Controller
{
    public function finance()
    {
        $data = DB::table('pembayarans')
            ->join('tagihans', 'pembayarans.tagihan_id', '=', 'tagihans.id')
            ->where('pembayarans.status', 'accepted')
            ->select(
                DB::raw('MONTH(pembayarans.created_at) as bulan'),
                DB::raw('SUM(tagihans.jumlah) as total')
            )
            ->groupBy(DB::raw('MONTH(pembayarans.created_at)'))
            ->orderBy('bulan')
            ->get();

        return response()->json($data);
    }
}
