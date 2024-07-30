<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaldoAwalRequest;
use App\Http\Requests\UpdateSaldoAwalRequest;
use App\Models\SaldoAwal;
use Illuminate\Http\Request;

class SaldoAwalController extends BaseController
{
    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = SaldoAwal::all();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(Request $request)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $request->saldo);
        $data = array();
        try {
            $data = new SaldoAwal();
            $data->saldo = $numericValue;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }
}
