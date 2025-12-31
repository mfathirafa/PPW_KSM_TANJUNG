<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FinanceReportController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        /*
        |--------------------------------------------------------------------------
        | TOTAL PEMASUKAN BULAN INI
        |--------------------------------------------------------------------------
        */
        $totalPemasukan = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->whereRaw('LOWER(pembayarans.status) = ?', ['accepted'])
            ->whereMonth('pembayarans.created_at', $bulan)
            ->whereYear('pembayarans.created_at', $tahun)
            ->sum('tagihans.jumlah');

        /*
        |--------------------------------------------------------------------------
        | TOTAL TAGIHAN BULAN INI
        |--------------------------------------------------------------------------
        */
        $totalTagihan = Tagihan::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | DATA GRAFIK PEMASUKAN 1 TAHUN
        |--------------------------------------------------------------------------
        */
        $chartRaw = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->selectRaw('
                MONTH(pembayarans.created_at) AS bulan,
                SUM(tagihans.jumlah) AS total
            ')
            ->whereRaw('LOWER(pembayarans.status) = ?', ['accepted'])
            ->whereYear('pembayarans.created_at', $tahun)
            ->groupBy(DB::raw('MONTH(pembayarans.created_at)'))
            ->orderBy(DB::raw('MONTH(pembayarans.created_at)'))
            ->get();

        $chartLabels = [];
        $chartData   = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = Carbon::create()->month($i)->translatedFormat('F');
            $found = $chartRaw->firstWhere('bulan', $i);
            $chartData[] = $found ? (int) $found->total : 0;
        }

        /*
        |--------------------------------------------------------------------------
        | LAPORAN BULANAN (TABEL)
        |--------------------------------------------------------------------------
        */
        $laporanBulanan = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->selectRaw('
                MONTH(pembayarans.created_at) AS bulan,
                YEAR(pembayarans.created_at) AS tahun,
                SUM(tagihans.jumlah) AS total_pemasukan
            ')
            ->whereRaw('LOWER(pembayarans.status) = ?', ['accepted'])
            ->groupBy(
                DB::raw('MONTH(pembayarans.created_at)'),
                DB::raw('YEAR(pembayarans.created_at)')
            )
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.reports.finance', [
            'totalPemasukan' => $totalPemasukan,
            'totalTagihan'   => $totalTagihan,
            'chartLabels'    => $chartLabels, // ⬅️ ARRAY ASLI
            'chartData'      => $chartData,   // ⬅️ ARRAY ASLI
            'laporanBulanan' => $laporanBulanan,
            'bulan'          => $bulan,
            'tahun'          => $tahun,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT CSV
    |--------------------------------------------------------------------------
    */
    public function exportCsv()
    {
        $filename = 'laporan_keuangan.csv';

        $data = Pembayaran::with('tagihan.pelanggan.user')
            ->whereRaw('LOWER(status) = ?', ['accepted'])
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Tanggal', 'Pelanggan', 'Jumlah', 'Metode']);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->created_at->format('d-m-Y'),
                    $row->tagihan->pelanggan->user->name ?? '-',
                    $row->tagihan->jumlah,
                    strtoupper($row->method),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */
    public function exportPdf()
    {
        $pembayaran = Pembayaran::with('tagihan.pelanggan.user')
            ->whereRaw('LOWER(status) = ?', ['accepted'])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPemasukan = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->whereRaw('LOWER(pembayarans.status) = ?', ['accepted'])
            ->sum('tagihans.jumlah');

        $pdf = Pdf::loadView('admin.reports.finance-pdf', [
            'pembayaran'     => $pembayaran,
            'totalPemasukan' => $totalPemasukan,
            'tanggal'        => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->download('laporan_keuangan_ksm_tanjung.pdf');
    }
}