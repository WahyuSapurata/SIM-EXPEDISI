<?php

namespace App\Http\Controllers;

use App\Models\OperasionalKantor;
use App\Models\Penawaran;
use App\Models\Piutan;
use App\Models\RealCost;
use App\Models\SaldoAwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function index()
    {
        $module = 'Laporan';
        return view('admin.laporan.index', compact('module'));
    }

    public function owner()
    {
        $module = 'Laporan';
        return view('owner.laporan.index', compact('module'));
    }

    public function get($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        // Mengubah format tanggal menjadi Y-m-d
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $startDateStr)->format('Y-m-d');
        $endDate = \Carbon\Carbon::createFromFormat('d-m-Y', $endDateStr)->format('Y-m-d');

        // Mengambil semua data dari tabel terkait
        $operasional = OperasionalKantor::all();
        $penawaran = Penawaran::all();
        $piutang = Piutan::all();
        $realcost = RealCost::all();

        // Menggabungkan semua data ke dalam satu koleksi
        $mergedData = collect()
            ->merge($operasional)
            ->merge($penawaran)
            ->merge($piutang)
            ->merge($realcost);

        $combinedData = $mergedData->map(function ($item) {
            if ($item instanceof OperasionalKantor) {
                $item->tanggal = $item->tanggal ? \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') : null;
                $item->keluar = $item->harga * $item->qty;
            } elseif ($item instanceof Penawaran) {
                $item->tanggal = $item->tanggal ? \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') : null;
                $item->item = $item->jenis_barang;
                $item->masuk = $item->harga;
            } elseif ($item instanceof Piutan) {
                // Tambahkan pengecekan apakah terbayarkan tidak kosong
                if (!empty($item->terbayarkan)) {
                    $data_realcost = RealCost::where('uuid', $item->uuid_realcost)->first();
                    if ($data_realcost) {
                        // Jika jenis_muatan adalah array, ambil elemen pertama atau gabungkan semua elemen
                        $jenis_muatan = is_array($data_realcost->jenis_muatan) ? implode(', ', $data_realcost->jenis_muatan) : $data_realcost->jenis_muatan;
                        $item->tanggal = $item->created_at ? $item->created_at->format('Y-m-d') : null;
                        $item->item = 'Pelunasan ' . $jenis_muatan;
                        $item->masuk = $item->terbayarkan;
                    }
                } else {
                    return null; // Mengembalikan null jika terbayarkan kosong
                }
            } elseif ($item instanceof RealCost) {
                if (!empty($item->terbayarkan)) {
                    // Jika jenis_muatan adalah array, ambil elemen pertama atau gabungkan semua elemen
                    $jenis_muatan = is_array($item->jenis_muatan) ? implode(', ', $item->jenis_muatan) : $item->jenis_muatan;
                    $item->item = $jenis_muatan;
                    $item->tanggal = $item->tanggal ? \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') : null;
                    $item->masuk = $item->terbayarkan;
                } else {
                    return null; // Mengembalikan null jika terbayarkan kosong
                }
            }
            return $item;
        })->filter(); // Filter untuk menghapus item yang bernilai null

        // Memfilter data berdasarkan rentang tanggal
        $filteredData = $combinedData->filter(function ($item) use ($startDate, $endDate) {
            return $item->tanggal >= $startDate && $item->tanggal <= $endDate;
        });

        // Mengurutkan data berdasarkan tanggal
        $sortedData = $filteredData->sort(function ($a, $b) {
            return strcmp($a->tanggal, $b->tanggal);
        })->values()->all();

        // Mengembalikan respon
        return $this->sendResponse($sortedData, 'Get data success');
    }

    public function exportToExcel($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        // Mengubah format tanggal menjadi Y-m-d
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $startDateStr)->format('Y-m-d');
        $endDate = \Carbon\Carbon::createFromFormat('d-m-Y', $endDateStr)->format('Y-m-d');

        // Mengambil semua data dari tabel terkait
        $operasional = OperasionalKantor::all();
        $penawaran = Penawaran::all();
        $piutang = Piutan::all();
        $realcost = RealCost::all();

        // Menggabungkan semua data ke dalam satu koleksi
        $mergedData = collect()
            ->merge($operasional)
            ->merge($penawaran)
            ->merge($piutang)
            ->merge($realcost);

        $combinedData = $mergedData->map(function ($item) {
            if ($item instanceof OperasionalKantor) {
                $item->tanggal = $item->tanggal ? \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') : null;
                $item->keluar = $item->harga * $item->qty;
            } elseif ($item instanceof Penawaran) {
                $item->tanggal = $item->tanggal ? \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') : null;
                $item->item = $item->jenis_barang;
                $item->masuk = $item->harga;
            } elseif ($item instanceof Piutan) {
                // Tambahkan pengecekan apakah terbayarkan tidak kosong
                if (!empty($item->terbayarkan)) {
                    $data_realcost = RealCost::where('uuid', $item->uuid_realcost)->first();
                    if ($data_realcost) {
                        // Jika jenis_muatan adalah array, ambil elemen pertama atau gabungkan semua elemen
                        $jenis_muatan = is_array($data_realcost->jenis_muatan) ? implode(', ', $data_realcost->jenis_muatan) : $data_realcost->jenis_muatan;
                        $item->tanggal = $item->created_at ? $item->created_at->format('Y-m-d') : null;
                        $item->item = 'Pelunasan ' . $jenis_muatan;
                        $item->masuk = $item->terbayarkan;
                    }
                } else {
                    return null; // Mengembalikan null jika terbayarkan kosong
                }
            } elseif ($item instanceof RealCost) {
                if (!empty($item->terbayarkan)) {
                    // Jika jenis_muatan adalah array, ambil elemen pertama atau gabungkan semua elemen
                    $jenis_muatan = is_array($item->jenis_muatan) ? implode(', ', $item->jenis_muatan) : $item->jenis_muatan;
                    $item->item = $jenis_muatan;
                    $item->tanggal = $item->tanggal ? \Carbon\Carbon::createFromFormat('d-m-Y', $item->tanggal)->format('Y-m-d') : null;
                    $item->masuk = $item->terbayarkan;
                } else {
                    return null; // Mengembalikan null jika terbayarkan kosong
                }
            }
            return $item;
        })->filter(); // Filter untuk menghapus item yang bernilai null

        // Memfilter data berdasarkan rentang tanggal
        $filteredData = $combinedData->filter(function ($item) use ($startDate, $endDate) {
            return $item->tanggal >= $startDate && $item->tanggal <= $endDate;
        });

        // Mengurutkan data berdasarkan tanggal
        $sortedData = $filteredData->sort(function ($a, $b) {
            return strcmp($a->tanggal, $b->tanggal);
        })->values()->all();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Ambil objek aktif (sheet aktif)
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
        $sheet->getRowDimension(1)->setRowHeight(30);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $fontStyle = [
            'font' => [
                'name' => 'Times New Roman',
                'size' => 12,
            ],
        ];

        // Isi data ke dalam sheet

        $centerStyle = [
            'alignment' => [
                //'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $sheet->setCellValue('A1', 'LAPORAN')->mergeCells('A1:F1');
        $sheet->setCellValue('A2', 'MULAI DARI TANGGAL ' . $startDateStr . ' SAMPAI ' . $endDateStr)->mergeCells('A2:F2');

        $sheet->setCellValue('A4', 'PT.DUNIA LINTAS MANDIRI')->mergeCells('A4:F4');
        $sheet->setCellValue('A5', 'Shipping, Freight Forwarding & Domestic Cargo')->mergeCells('A5:F5');
        $sheet->setCellValue('A6', 'Office: Jl. Kelapa Hibrida Blok QH 10 No 6, Kelapa Gading, Jakarta Utara 14240')->mergeCells('A6:F6');
        $sheet->setCellValue('A7', 'Telp: 021-2422 3333 | 0811 122 667')->mergeCells('A7:F7');
        $sheet->setCellValue('A8', 'Email: dunialintasmandiri@gmail.com')->mergeCells('A8:F8');

        $sheet->setCellValue('A10', 'NO');
        $sheet->setCellValue('B10', 'TANGGAL');
        $sheet->setCellValue('C10', 'KETERANGAN');
        $sheet->setCellValue('D10', 'KELUAR');
        $sheet->setCellValue('E10', 'MASUK');
        $sheet->setCellValue('F10', 'KAS');

        // Memberikan warna pada sel-sel baris ke-10
        $sheet->getStyle('A10:F10')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'acb9ca', // Warna Peach
                ],
            ],
        ]);

        $row = 11;
        $subtotalTotal = 0;

        foreach ($sortedData as $index => $lap) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $lap->tanggal);
            $sheet->setCellValue('C' . $row, $lap->item);
            $sheet->setCellValue('D' . $row, $lap->keluar ? "Rp " . number_format($lap->keluar, 0, ',', '.') : '-');
            $sheet->setCellValue('E' . $row, $lap->masuk ? "Rp " . number_format($lap->masuk, 0, ',', '.') : '-');

            // Format rupiah pada kolom H
            $sisa_saldo = $lap->masuk - $lap->keluar;
            $subtotalTotal += $sisa_saldo;
            $sheet->setCellValue('F' . $row, "Rp " . number_format($subtotalTotal, 0, ',', '.'));

            $row++;
        }

        // Baris Total
        $sheet->setCellValue('A' . $row, 'Total Saldo'); // Gantilah 'Total' dengan label yang sesuai
        $sheet->mergeCells('A' . $row . ':E' . $row); // Gabungkan sel dari A hingga E
        $sheet->setCellValue('F' . $row, "Rp " . number_format($subtotalTotal, 0, ',', '.')); // Menghitung total
        // Menerapkan gaya untuk sel total
        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'acb9ca', // Warna Peach
                ],
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $row++; // Pindahkan ke baris berikutnya

        // Ambil objek kolom terakhir yang memiliki data (A, B, C, dst.)
        $lastColumn = $sheet->getHighestDataColumn();

        // Iterate melalui kolom-kolom yang memiliki data dan atur lebar kolomnya
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Menerapkan style alignment untuk seluruh sel dalam spreadsheet
        $sheet->getStyle('A1:' . $lastColumn . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('C4:' . $lastColumn . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A3:I3')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A11:A' . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A1:I1')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('E7:E8')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Memberikan border ke seluruh sel di tabel (baris ke-10 hingga baris terakhir sebelum total)
        $sheet->getStyle('A10:F' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $excelFileName = 'laporan_' . $params . '.xlsx';
        $excelFilePath = public_path($excelFileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);

        // Kembalikan response dengan file PDF yang diunduh
        return response()->download(public_path($excelFileName));
    }

    public function cetak_neraca($params)
    {
        $module = 'Neraca Saldo';

        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // Memastikan $dateParts berisi dua tanggal
        if (count($dateParts) !== 2) {
            return response()->json(['error' => 'Rentang tanggal tidak valid.'], 400);
        }

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        // Mengubah format tanggal menjadi Y-m-d
        try {
            $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $startDateStr)->format('Y-m-d');
            $endDate = \Carbon\Carbon::createFromFormat('d-m-Y', $endDateStr)->format('Y-m-d');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Format tanggal tidak valid.'], 400);
        }

        // Mengambil semua data dari tabel terkait berdasarkan rentang tanggal
        $operasional = OperasionalKantor::where('kategori', 'operasional')
            ->whereBetween(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%d-%m-%Y"), "%Y-%m-%d")'), [$startDate, $endDate])
            ->get();

        $inventaris = OperasionalKantor::where('kategori', 'inventaris')
            ->whereBetween(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%d-%m-%Y"), "%Y-%m-%d")'), [$startDate, $endDate])
            ->get();

        $biaya = OperasionalKantor::where('kategori', 'biaya')
            ->whereBetween(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%d-%m-%Y"), "%Y-%m-%d")'), [$startDate, $endDate])
            ->get();

        $piutang = Piutan::whereBetween(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate])->get();
        $realcost = RealCost::whereBetween(DB::raw('DATE_FORMAT(STR_TO_DATE(tanggal, "%d-%m-%Y"), "%Y-%m-%d")'), [$startDate, $endDate])->get();
        $saldo = SaldoAwal::all(); // Asumsikan saldo awal tidak memiliki tanggal

        // Menghitung total saldo awal dan real cost
        $s = $saldo->sum('saldo');
        $r = $realcost->sum('terbayarkan');

        // Menghitung total piutang
        $p = $piutang->sum('terbayarkan');

        // Menghitung total operasional
        $opr = $operasional->sum(function ($item) {
            return $item->qty * $item->harga;
        });

        // Menghitung total inventaris
        $inv = $inventaris->sum(function ($item) {
            return $item->qty * $item->harga;
        });

        // Menghitung total biaya
        $biy = $biaya->sum(function ($item) {
            return $item->qty * $item->harga;
        });

        // Menyusun hasil
        $result = [
            'kas' => $s + $r,
            'piutang' => $p,
            'operasional' => $opr,
            'inventaris' => $inv,
            'biaya_lain' => $biy,
        ];
        return view('pdf.neraca', compact('module', 'startDateStr', 'endDateStr', 'result'));
    }
}
