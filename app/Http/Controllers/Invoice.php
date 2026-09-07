<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
use App\Models\Piutan;
use App\Models\RealCost;
use Illuminate\Http\Request;

class Invoice extends BaseController
{
    public function index()
    {
        $module = 'Invoice';
        return view('admin.invoice.index', compact('module'));
    }

    public function owner()
    {
        $module = 'Invoice';
        return view('owner.invoice.index', compact('module'));
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

    public function update(Request $request, $params)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $request->terbayarkan);
        try {
            // Ambil data berdasarkan UUID
            $data = RealCost::where('uuid', $params)->first();

            // Jika data ditemukan
            if ($data) {
                // Update nilai terbayarkan
                $data->terbayarkan = $numericValue;

                // Hitung total harga berdasarkan array harga dan qty
                $total_harga = 0;
                foreach ($data->harga as $index => $harga) {
                    $qty = $data->qty[$index] ?? 0;
                    $total_harga += $harga * $qty;
                }

                // Jika total harga tidak sama dengan terbayarkan, buat record piutang
                if ($total_harga != $numericValue) {
                    $piutang = new Piutan(); // Perbaiki nama kelas menjadi Piutang
                    $piutang->uuid_realcost = $params;
                    $piutang->save();
                }

                // Simpan perubahan data
                $data->save();
            } else {
                // Jika data tidak ditemukan
                return $this->sendError('Data not found', 'Data not found', 404);
            }
        } catch (\Exception $e) {
            // Tangani pengecualian
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        // Kirimkan respons sukses
        return $this->sendResponse($data, 'Update data success');
    }


    public function print($params)
    {
        $invoice = RealCost::where('uuid', $params)->first();
        $data_costumer = DataCustomer::where('uuid', $invoice->uuid_customer)->first();
        return view('pdf.invoice', compact('invoice', 'data_costumer'))->render();
    }
}
