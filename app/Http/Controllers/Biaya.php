<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestBiaya;
use App\Models\OperasionalKantor;
use Illuminate\Http\Request;

class Biaya extends BaseController
{
    public function index()
    {
        $module = 'Biaya Lain';
        return view('admin.biaya.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = OperasionalKantor::where('kategori', 'biaya')->get();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreRequestBiaya $storeRequestBiaya)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeRequestBiaya->harga);
        $data = array();
        try {
            $data = new OperasionalKantor();
            $data->kategori = 'biaya';
            $data->tanggal = $storeRequestBiaya->tanggal;
            $data->item = $storeRequestBiaya->item;
            $data->qty = $storeRequestBiaya->qty;
            $data->satuan = $storeRequestBiaya->satuan;
            $data->harga = $numericValue;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = OperasionalKantor::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreRequestBiaya $storeRequestBiaya, $params)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeRequestBiaya->harga);
        try {
            $data = OperasionalKantor::where('uuid', $params)->first();
            $data->kategori = 'biaya';
            $data->tanggal = $storeRequestBiaya->tanggal;
            $data->item = $storeRequestBiaya->item;
            $data->qty = $storeRequestBiaya->qty;
            $data->satuan = $storeRequestBiaya->satuan;
            $data->harga = $numericValue;
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
            $data = OperasionalKantor::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
