<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class FinanceReportController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        // TOTAL PEMASUKAN
        $totalPemasukan = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->where('pembayarans.status', 'accepted')
            ->whereMonth('pembayarans.created_at', $bulan)
            ->whereYear('pembayarans.created_at', $tahun)
            ->sum('tagihans.jumlah');

        // TOTAL TAGIHAN
        $totalTagihan = Tagihan::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->count();

        // GRAFIK BULANAN (SETAHUN)
        $chartRaw = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->selectRaw('MONTH(pembayarans.created_at) bulan, SUM(tagihans.jumlah) total')
            ->where('pembayarans.status', 'accepted')
            ->whereYear('pembayarans.created_at', $tahun)
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $chartLabels = [];
        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartLabels[] = \Carbon\Carbon::create()->month($i)->translatedFormat('F');
            $found = $chartRaw->firstWhere('bulan', $i);
            $chartData[] = $found ? $found->total : 0;
        }

        // LAPORAN BULANAN (STEP 4.3)
        $laporanBulanan = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->selectRaw('
                MONTH(pembayarans.created_at) bulan,
                YEAR(pembayarans.created_at) tahun,
                SUM(tagihans.jumlah) total_pemasukan
            ')
            ->where('pembayarans.status', 'accepted')
            ->groupBy('bulan', 'tahun')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.reports.finance', compact(
            'totalPemasukan',
            'totalTagihan',
            'chartLabels',
            'chartData',
            'laporanBulanan'
        ));
    }

    public function exportCsv(Request $request)
    {
        $filename = 'laporan_keuangan.csv';

        $data = Pembayaran::with('tagihan.pelanggan.user')
            ->where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Tanggal', 'Pelanggan', 'Jumlah', 'Metode']);

            foreach ($data as $row) {
                fputcsv($file, [
                    $row->created_at->format('d-m-Y'),
                    $row->tagihan->pelanggan->user->name ?? '-',
                    $row->tagihan->jumlah,
                    $row->method,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPdf(Request $request)
    {
        $pembayaran = Pembayaran::with('tagihan.pelanggan.user')
            ->where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPemasukan = Pembayaran::join(
                'tagihans',
                'pembayarans.tagihan_id',
                '=',
                'tagihans.id'
            )
            ->where('pembayarans.status', 'accepted')
            ->sum('tagihans.jumlah');

        $pdf = Pdf::loadView('admin.reports.finance-pdf', [
            'pembayaran'     => $pembayaran,
            'totalPemasukan' => $totalPemasukan,
            'tanggal'        => now()->translatedFormat('d F Y'),
        ]);

        return $pdf->download('laporan_keuangan_ksm_tanjung.pdf');
    }
}