<?php

namespace App\Http\Controllers;

use App\Models\CplProdi;
use App\Models\Cpmk;
use App\Models\Mahasiswa;
use App\Models\OperasionalKantor;
use App\Models\Penawaran;
use App\Models\Penilaian;
use App\Models\Piutan;
use App\Models\RealCost;
use App\Models\SaldoAwal;
use App\Models\SubCpmk;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends BaseController
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->back();
        }
        return redirect()->route('login.dlm-akun');
    }

    public function error500()
    {
        return view('error.500');
    }

    public function dashboard_admin()
    {
        $module = 'Dashboard';

        $operasional = OperasionalKantor::all();
        $penawaran = Penawaran::all();
        $piutang = Piutan::all();
        $realcost = RealCost::all();

        $saldo = SaldoAwal::all();

        $opr = 0;
        foreach ($operasional as $item_opr) {
            $opr += $item_opr->qty * $item_opr->harga;
        }
        $pnr = 0;
        foreach ($penawaran as $item_pnr) {
            $pnr += $item_pnr->harga;
        }
        $ptn = 0;
        foreach ($piutang as $item_ptn) {
            $ptn += $item_ptn->terbayarkan;
        }
        $real = 0;
        foreach ($realcost as $item_real) {
            $real += $item_real->terbayarkan;
        }

        $sa = 0;
        foreach ($saldo as $item_saldo) {
            $sa += $item_saldo->saldo;
        }

        $pendapatan = $pnr + $ptn + $real;
        $pengeluaran = $opr;
        $kas = $pendapatan - $pengeluaran + $sa;

        return view('dashboard.admin', compact('module', 'pendapatan', 'pengeluaran', 'kas'));
    }

    public function dashboard_owner()
    {
        $module = 'Dashboard';

        $operasional = OperasionalKantor::all();
        $penawaran = Penawaran::all();
        $piutang = Piutan::all();
        $realcost = RealCost::all();

        $saldo = SaldoAwal::all();

        $opr = 0;
        foreach ($operasional as $item_opr) {
            $opr += $item_opr->qty * $item_opr->harga;
        }
        $pnr = 0;
        foreach ($penawaran as $item_pnr) {
            $pnr += $item_pnr->harga;
        }
        $ptn = 0;
        foreach ($piutang as $item_ptn) {
            $ptn += $item_ptn->terbayarkan;
        }
        $real = 0;
        foreach ($realcost as $item_real) {
            $real += $item_real->terbayarkan;
        }

        $sa = 0;
        foreach ($saldo as $item_saldo) {
            $sa += $item_saldo->saldo;
        }

        $pendapatan = $pnr + $ptn + $real;
        $pengeluaran = $opr;
        $kas = $pendapatan - $pengeluaran + $sa;

        return view('dashboard.owner', compact('module', 'pendapatan', 'pengeluaran', 'kas'));
    }

    public function areaChart(Request $request)
    {
        // Mengambil input bulan dan tahun dari request
        $year = $request->input('year');
        $month = $request->input('month');

        // Array nama bulan dalam bahasa Indonesia
        $monthsIndonesian = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        // Inisialisasi array data untuk grafik
        $result = [
            'labels' => [],
            'pendapatan' => [],
            'pengeluaran' => [],
            'laba' => [],
        ];

        // Fungsi untuk memeriksa apakah ada data dalam array
        $hasData = function ($data) {
            return !$data->isEmpty();
        };

        // Jika input bulan diberikan, ambil data berdasarkan bulan
        if ($month) {
            $monthNamesIndonesian = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
            ];

            // Contoh input bulan dalam bahasa Indonesia
            $inputMonth = $month; // Gantilah dengan input sebenarnya

            // Konversi nama bulan menjadi angka bulan
            $month = array_search($inputMonth, $monthNamesIndonesian);

            // Ambil data dari database
            $realCostData = DB::table('real_costs')
                ->select(DB::raw('SUM(CAST(terbayarkan AS DECIMAL)) as total_realcost, DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") as periode'))
                ->whereRaw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") = ?', [$month])
                ->groupBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->get();

            $piutangData = DB::table('piutans')
                ->select(DB::raw('SUM(CAST(terbayarkan AS DECIMAL)) as total_piutang, DATE_FORMAT(created_at, "%m") as periode'))
                ->whereRaw('DATE_FORMAT(created_at, "%m") = ?', [$month])
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(created_at, "%m")'))
                ->get();

            $penawaranData = DB::table('penawarans')
                ->select(DB::raw('SUM(CAST(harga AS DECIMAL)) as total_penawaran, DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") as periode'))
                ->whereRaw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") = ?', [$month])
                ->groupBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->get();

            $operasionalData = DB::table('operasional_kantors')
                ->select(DB::raw('SUM(CAST(qty AS DECIMAL) * CAST(harga AS DECIMAL)) as total_operasional, DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") as periode'))
                ->whereRaw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") = ?', [$month])
                ->groupBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->get();

            // Konversi periode ke nama bulan dalam bahasa Indonesia
            foreach ($realCostData as $data) {
                $data->periode = $monthNamesIndonesian[$data->periode];
            }

            foreach ($piutangData as $data) {
                $data->periode = $monthNamesIndonesian[$data->periode];
            }

            foreach ($penawaranData as $data) {
                $data->periode = $monthNamesIndonesian[$data->periode];
            }

            foreach ($operasionalData as $data) {
                $data->periode = $monthNamesIndonesian[$data->periode];
            }

            // Menggabungkan periode dari semua data untuk memastikan semua periode terdaftar
            $allPeriods = array_unique(array_merge(
                $realCostData->pluck('periode')->toArray(),
                $piutangData->pluck('periode')->toArray(),
                $penawaranData->pluck('periode')->toArray(),
                $operasionalData->pluck('periode')->toArray()
            ));
            sort($allPeriods);

            // Mengisi array dengan periode yang ada dan inisialisasi pendapatan dan pengeluaran
            foreach ($allPeriods as $period) {
                $result['labels'][] = $period; // Format periode menjadi nama bulan dalam bahasa Indonesia
                $result['pendapatan'][] = 0;
                $result['pengeluaran'][] = 0;
                $result['laba'][] = 0; // Inisialisasi laba
            }

            // Mengisi array data pendapatan dan pengeluaran
            foreach ($realCostData as $row) {
                $index = array_search($row->periode, $result['labels']);
                $result['pendapatan'][$index] = (int) $row->total_realcost;
            }

            foreach ($piutangData as $row) {
                $index = array_search($row->periode, $result['labels']);
                $result['pendapatan'][$index] += (int) $row->total_piutang;
            }

            foreach ($penawaranData as $row) {
                $index = array_search($row->periode, $result['labels']);
                $result['pendapatan'][$index] += (int) $row->total_penawaran;
            }

            foreach ($operasionalData as $row) {
                $index = array_search($row->periode, $result['labels']);
                $result['pengeluaran'][$index] = (int) $row->total_operasional;
            }

            // Jika input tahun diberikan, ambil data berdasarkan tahun
        } elseif ($year) {
            $realCostData = DB::table('real_costs')
                ->select(DB::raw('SUM(CAST(terbayarkan AS DECIMAL)) as total_realcost, DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") as bulan'))
                ->whereYear('tanggal', '=', $year)
                ->groupBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->get();

            $piutangData = DB::table('piutans')
                ->select(DB::raw('SUM(CAST(terbayarkan AS DECIMAL)) as total_piutang, DATE_FORMAT(created_at, "%m") as bulan'))
                ->whereYear('created_at', '=', $year)
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(created_at, "%m")'))
                ->get();

            $penawaranData = DB::table('penawarans')
                ->select(DB::raw('SUM(CAST(harga AS DECIMAL)) as total_penawaran, DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") as bulan'))
                ->whereYear(DB::raw('STR_TO_DATE(tanggal, "%Y-%m-%d")'), '=', $year)
                ->groupBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->get();

            $operasionalData = DB::table('operasional_kantors')
                ->select(DB::raw('SUM(CAST(qty AS DECIMAL) * CAST(harga AS DECIMAL)) as total_operasional, DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m") as bulan'))
                ->whereYear('tanggal', '=', $year)
                ->groupBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->orderBy(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%Y-%m-%d"), "%m")'))
                ->get();

            // Menggabungkan bulan dari semua data untuk memastikan semua bulan terdaftar
            $allMonths = array_unique(array_merge(
                $realCostData->pluck('bulan')->toArray(),
                $piutangData->pluck('bulan')->toArray(),
                $penawaranData->pluck('bulan')->toArray(),
                $operasionalData->pluck('bulan')->toArray()
            ));
            sort($allMonths);

            // Mengisi array dengan bulan-bulan yang ada dan inisialisasi pendapatan dan pengeluaran
            foreach ($allMonths as $month) {
                $result['labels'][] = $monthsIndonesian[$month]; // Mengubah format bulan menjadi nama bulan dalam bahasa Indonesia
                $result['pendapatan'][] = 0;
                $result['pengeluaran'][] = 0;
                $result['laba'][] = 0; // Inisialisasi laba
            }

            // Mengisi array data pendapatan
            foreach ($realCostData as $row) {
                $index = array_search($monthsIndonesian[$row->bulan], $result['labels']);
                $result['pendapatan'][$index] = (int) $row->total_realcost;
            }

            foreach ($piutangData as $row) {
                $index = array_search($monthsIndonesian[$row->bulan], $result['labels']);
                $result['pendapatan'][$index] += (int) $row->total_piutang;
            }

            foreach ($penawaranData as $row) {
                $index = array_search($monthsIndonesian[$row->bulan], $result['labels']);
                $result['pendapatan'][$index] += (int) $row->total_penawaran;
            }

            // Mengisi array data operasional
            foreach ($operasionalData as $row) {
                $index = array_search($monthsIndonesian[$row->bulan], $result['labels']);
                $result['pengeluaran'][$index] = (int) $row->total_operasional;
            }
        }

        // Menghitung laba
        foreach ($result['labels'] as $index => $label) {
            $result['laba'][$index] = $result['pendapatan'][$index] - $result['pengeluaran'][$index];
        }

        // Menghapus bulan/tahun yang tidak memiliki data
        $filteredResult = [
            'labels' => [],
            'pendapatan' => [],
            'pengeluaran' => [],
            'laba' => [],
        ];

        foreach ($result['labels'] as $index => $label) {
            if ($result['pendapatan'][$index] != 0 || $result['pengeluaran'][$index] != 0 || $result['laba'][$index] != 0) {
                $filteredResult['labels'][] = $label;
                $filteredResult['pendapatan'][] = $result['pendapatan'][$index];
                $filteredResult['pengeluaran'][] = $result['pengeluaran'][$index];
                $filteredResult['laba'][] = $result['laba'][$index];
            }
        }

        // Mengembalikan data dalam format JSON
        return $this->sendResponse($filteredResult, 'Get data success');
    }
}
