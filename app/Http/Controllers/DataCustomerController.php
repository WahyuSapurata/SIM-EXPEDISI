<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataCustomerRequest;
use App\Http\Requests\UpdateDataCustomerRequest;
use App\Models\DataCustomer;

class DataCustomerController extends BaseController
{
    public function index()
    {
        $module = 'Data Customer';
        return view('admin.customer.index', compact('module'));
    }

    public function owner()
    {
        $module = 'Data Customer';
        return view('owner.customer.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = DataCustomer::all();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StoreDataCustomerRequest $storeDataCustomerRequest)
    {
        $data = array();
        try {
            $data = new DataCustomer();
            $data->nama = $storeDataCustomerRequest->nama;
            $data->nomor_hp = $storeDataCustomerRequest->nomor_hp;
            $data->alamat = $storeDataCustomerRequest->alamat;
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
            $data = DataCustomer::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StoreDataCustomerRequest $storeDataCustomerRequest, $params)
    {
        try {
            $data = DataCustomer::where('uuid', $params)->first();
            $data->nama = $storeDataCustomerRequest->nama;
            $data->nomor_hp = $storeDataCustomerRequest->nomor_hp;
            $data->alamat = $storeDataCustomerRequest->alamat;
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
            $data = DataCustomer::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
