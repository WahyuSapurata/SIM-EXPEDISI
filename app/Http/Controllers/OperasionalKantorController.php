<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperasionalKantorRequest;
use App\Http\Requests\UpdateOperasionalKantorRequest;
use App\Models\OperasionalKantor;

class OperasionalKantorController extends BaseController
{
    public function index()
    {
        $module = 'Biaya Operasional';
        return view('admin.operasional.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = OperasionalKantor::where('kategori', 'operasional')->get();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreOperasionalKantorRequest $storeOperasionalKantorRequest)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeOperasionalKantorRequest->harga);
        $data = array();
        try {
            $data = new OperasionalKantor();
            $data->kategori = 'operasional';
            $data->tanggal = $storeOperasionalKantorRequest->tanggal;
            $data->item = $storeOperasionalKantorRequest->item;
            $data->qty = $storeOperasionalKantorRequest->qty;
            $data->satuan = $storeOperasionalKantorRequest->satuan;
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

    public function update(StoreOperasionalKantorRequest $storeOperasionalKantorRequest, $params)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeOperasionalKantorRequest->harga);
        try {
            $data = OperasionalKantor::where('uuid', $params)->first();
            $data->kategori = 'operasional';
            $data->tanggal = $storeOperasionalKantorRequest->tanggal;
            $data->item = $storeOperasionalKantorRequest->item;
            $data->qty = $storeOperasionalKantorRequest->qty;
            $data->satuan = $storeOperasionalKantorRequest->satuan;
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
