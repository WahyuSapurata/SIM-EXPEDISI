<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestByInvetaris;
use App\Models\OperasionalKantor;
use Illuminate\Http\Request;

class ByInvetaris extends BaseController
{
    public function index()
    {
        $module = 'By Invetaris';
        return view('admin.invetaris.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = OperasionalKantor::where('kategori', 'invetaris')->get();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreRequestByInvetaris $storeRequestByInvetaris)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeRequestByInvetaris->harga);
        $data = array();
        try {
            $data = new OperasionalKantor();
            $data->kategori = 'invetaris';
            $data->tanggal = $storeRequestByInvetaris->tanggal;
            $data->item = $storeRequestByInvetaris->item;
            $data->qty = $storeRequestByInvetaris->qty;
            $data->satuan = $storeRequestByInvetaris->satuan;
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

    public function update(StoreRequestByInvetaris $storeRequestByInvetaris, $params)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storeRequestByInvetaris->harga);
        try {
            $data = OperasionalKantor::where('uuid', $params)->first();
            $data->kategori = 'invetaris';
            $data->tanggal = $storeRequestByInvetaris->tanggal;
            $data->item = $storeRequestByInvetaris->item;
            $data->qty = $storeRequestByInvetaris->qty;
            $data->satuan = $storeRequestByInvetaris->satuan;
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
