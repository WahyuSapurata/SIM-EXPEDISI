<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRealCostRequest;
use App\Http\Requests\UpdateRealCostRequest;
use App\Models\DataCustomer;
use App\Models\RealCost;
use Illuminate\Support\Facades\DB;

class RealCostController extends BaseController
{
    public function index()
    {
        $module = 'Input Data';
        return view('admin.realcost.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = RealCost::all();
        $dataFull->map(function ($item) {
            $data_costumer = DataCustomer::where('uuid', $item->uuid_customer)->first();

            $item->costumer = $data_costumer->nama;
            return $item;
        });

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreRealCostRequest $storeRealCostRequest)
    {
        $data = array();
        try {
            // Buat format tanggal saat ini
            $year = date('Y');
            $month = date('n'); // bulan dalam bentuk angka tanpa leading zero
            $romanMonth = $this->convertToRoman($month); // fungsi konversi angka ke romawi

            // Ambil nomor invoice terakhir untuk bulan dan tahun ini
            $lastInvoice = DB::table('real_costs')
                ->whereRaw('EXTRACT(YEAR FROM tanggal::timestamp) = ?', [$year])
                ->whereRaw('EXTRACT(MONTH FROM tanggal::timestamp) = ?', [$month])
                ->orderBy('id', 'desc')
                ->first();

            if ($lastInvoice) {
                // Jika ada invoice sebelumnya, ambil nomor terakhir dan tambah 1
                $lastNumber = (int) explode('-', $lastInvoice->no_invoice)[0]; // Ambil nomor urut pertama
                $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
            } else {
                // Jika belum ada invoice sebelumnya, mulai dari 01
                $newNumber = '01';
            }

            // Buat nomor invoice baru
            $newInvoiceNumber = "$newNumber-DUALIMA-$romanMonth-$year";

            // Mengelola input harga yang berupa array
            $hargaArray = $storeRealCostRequest->harga;
            $hargaNumericArray = array_map(function ($harga) {
                return (int) str_replace(['Rp', ',', ' '], '', $harga);
            }, $hargaArray);

            $data = new RealCost();
            $data->uuid_customer = $storeRealCostRequest->uuid_customer;
            $data->tanggal = $storeRealCostRequest->tanggal;
            $data->nama_kapal = $storeRealCostRequest->nama_kapal;
            $data->alamat_pengirim = $storeRealCostRequest->alamat_pengirim;
            $data->alamat_tujuan = $storeRealCostRequest->alamat_tujuan;
            $data->jenis_muatan = $storeRealCostRequest->jenis_muatan;
            $data->qty = $storeRealCostRequest->qty;
            $data->satuan = $storeRealCostRequest->satuan;
            $data->harga = $hargaNumericArray;
            $data->no_invoice = $newInvoiceNumber;
            $data->muat = $storeRealCostRequest->muat;
            $data->bongkar = $storeRealCostRequest->bongkar;
            $data->delevery = $storeRealCostRequest->delevery;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    private function convertToRoman($num)
    {
        $n = intval($num);
        $result = '';
        $lookup = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
        foreach ($lookup as $roman => $value) {
            $matches = intval($n / $value);
            $result .= str_repeat($roman, $matches);
            $n = $n % $value;
        }
        return $result;
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = RealCost::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreRealCostRequest $storeRealCostRequest, $params)
    {
        try {
            $data = RealCost::where('uuid', $params)->first();
            $previousDate = $data->tanggal;
            $newDate = $storeRealCostRequest->tanggal;

            // Cek apakah tanggal berubah ke bulan atau tahun yang berbeda
            if (date('Y-m', strtotime($previousDate)) !== date('Y-m', strtotime($newDate))) {
                // Buat format tanggal saat ini dari tanggal baru
                $year = date('Y', strtotime($newDate));
                $month = date('n', strtotime($newDate)); // bulan dalam bentuk angka tanpa leading zero
                $romanMonth = $this->convertToRoman($month); // fungsi konversi angka ke romawi

                // Ambil nomor invoice terakhir untuk bulan dan tahun dari tanggal baru
                $lastInvoice = DB::table('real_costs')
                    ->whereYear('tanggal', $year)
                    ->whereMonth('tanggal', $month)
                    ->orderBy('id', 'desc')
                    ->first();

                if ($lastInvoice) {
                    // Jika ada invoice sebelumnya, ambil nomor terakhir dan tambah 1
                    $lastNumber = (int) explode('-', $lastInvoice->no_invoice)[0]; // Ambil nomor urut pertama
                    $newNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
                } else {
                    // Jika belum ada invoice sebelumnya, mulai dari 01
                    $newNumber = '01';
                }

                // Buat nomor invoice baru
                $newInvoiceNumber = "$newNumber-DUALIMA-$romanMonth-$year";
                $data->no_invoice = $newInvoiceNumber;
            }

            // Mengelola input harga yang berupa array
            $hargaArray = $storeRealCostRequest->harga;
            $hargaNumericArray = array_map(function ($harga) {
                return (int) str_replace(['Rp', ',', ' '], '', $harga);
            }, $hargaArray);

            $data->uuid_customer = $storeRealCostRequest->uuid_customer;
            $data->tanggal = $newDate;
            $data->nama_kapal = $storeRealCostRequest->nama_kapal;
            $data->alamat_pengirim = $storeRealCostRequest->alamat_pengirim;
            $data->alamat_tujuan = $storeRealCostRequest->alamat_tujuan;
            $data->jenis_muatan = $storeRealCostRequest->jenis_muatan;
            $data->qty = $storeRealCostRequest->qty;
            $data->satuan = $storeRealCostRequest->satuan;
            $data->harga = $hargaNumericArray;
            $data->muat = $storeRealCostRequest->muat;
            $data->bongkar = $storeRealCostRequest->bongkar;
            $data->delevery = $storeRealCostRequest->delevery;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = RealCost::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
