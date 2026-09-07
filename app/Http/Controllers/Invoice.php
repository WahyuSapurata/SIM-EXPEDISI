<?php

namespace App\Http\Controllers;

use App\Models\DataCustomer;
use App\Models\Piutan;
use App\Models\RealCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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
        $query = DB::table('real_costs as rc')
            ->leftJoin(
                'data_customers as dc',
                'dc.uuid',
                '=',
                'rc.uuid_customer'
            )
            ->select([
                'rc.*',
                'dc.nama as costumer',
            ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
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
