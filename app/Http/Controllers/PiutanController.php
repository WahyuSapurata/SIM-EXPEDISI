<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePiutanRequest;
use App\Http\Requests\UpdatePiutanRequest;
use App\Models\DataCustomer;
use App\Models\Piutan;
use App\Models\RealCost;
use Illuminate\Http\Request;

class PiutanController extends BaseController
{
    public function index()
    {
        $module = 'Piutang';
        return view('admin.piutang.index', compact('module'));
    }

    public function owner()
    {
        $module = 'Piutang';
        return view('owner.piutang.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna dengan status 'Belum Lunas'
        $dataFull = Piutan::where('status', 'Belum Lunas')->get();

        $dataFull->map(function ($item) {
            // Ambil data RealCost berdasarkan UUID
            $data_realcost = RealCost::where('uuid', $item->uuid_realcost)->first();
            if ($data_realcost) {
                // Ambil data customer berdasarkan UUID customer
                $data_customer = DataCustomer::where('uuid', $data_realcost->uuid_customer)->first();

                // Update item dengan data yang relevan
                $item->costumer = $data_customer ? $data_customer->nama : 'N/A';
                $item->no_invoice = $data_realcost->no_invoice;
                $item->tanggal = $data_realcost->tanggal;
                $item->jenis_muatan = $data_realcost->jenis_muatan;

                // Hitung piutang berdasarkan array harga dan qty
                $total_harga = 0;
                foreach ($data_realcost->harga as $index => $harga) {
                    $qty = $data_realcost->qty[$index] ?? 0;
                    $total_harga += $harga * $qty;
                }

                // Hitung piutang
                $item->piutang = $total_harga - $data_realcost->terbayarkan;
            } else {
                // Jika data realcost tidak ditemukan
                $item->costumer = 'N/A';
                $item->no_invoice = 'N/A';
                $item->tanggal = 'N/A';
                $item->jenis_muatan = 'N/A';
                $item->piutang = 0;
            }

            return $item;
        });

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }


    public function show($params)
    {
        $data = array();
        try {
            $data = Piutan::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(Request $request, $params)
    {
        // Validasi input
        $request->validate([
            'terbayarkan' => 'required|string',
            'status' => 'required|string',
        ]);

        // Menghilangkan format dari input terbayarkan
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $request->terbayarkan);

        try {
            // Menemukan data berdasarkan UUID
            $data = Piutan::where('uuid', $params)->first();
            $data->terbayarkan = $data->terbayarkan + $numericValue;
            $data->status = $request->status;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Update data success');
    }
}
