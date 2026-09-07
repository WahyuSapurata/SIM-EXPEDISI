<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePiutanRequest;
use App\Http\Requests\UpdatePiutanRequest;
use App\Models\DataCustomer;
use App\Models\Piutan;
use App\Models\RealCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

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

    public function get(Request $request)
    {
        $query = DB::table('piutans as p')
            ->leftJoin('real_costs as rc', 'rc.uuid', '=', 'p.uuid_realcost')
            ->leftJoin('data_customers as dc', 'dc.uuid', '=', 'rc.uuid_customer')
            ->where('p.status', 'Belum Lunas')
            ->select([
                'p.*',
                'rc.no_invoice',
                'rc.tanggal',
                'rc.jenis_muatan',
                'rc.harga',
                'rc.qty',
                'rc.terbayarkan',
                'dc.nama as costumer',
            ]);

        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('total_harga', function ($row) {

                $hargaArray = $this->parseJsonArray($row->harga);
                $qtyArray   = $this->parseJsonArray($row->qty);

                $totalHarga = 0;

                $length = min(
                    count($hargaArray),
                    count($qtyArray)
                );

                for ($i = 0; $i < $length; $i++) {

                    $harga = (float) $hargaArray[$i];
                    $qty   = (float) $qtyArray[$i];

                    $totalHarga += $harga * $qty;
                }

                return $totalHarga;
            })

            ->addColumn('piutang', function ($row) {

                $hargaArray = $this->parseJsonArray($row->harga);
                $qtyArray   = $this->parseJsonArray($row->qty);

                $totalHarga = 0;

                $length = min(
                    count($hargaArray),
                    count($qtyArray)
                );

                for ($i = 0; $i < $length; $i++) {

                    $harga = (float) $hargaArray[$i];
                    $qty   = (float) $qtyArray[$i];

                    $totalHarga += $harga * $qty;
                }

                $terbayarkan = (float) ($row->terbayarkan ?? 0);

                return max(0, $totalHarga - $terbayarkan);
            })

            ->make(true);
    }

    /**

Mengubah JSON string menjadi array.
     */
    private function parseJsonArray($value)
    {
        if (empty($value)) {
            return [];
        }

        // Jika sudah array
        if (is_array($value)) {
            return $value;
        }

        // Decode JSON
        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : [];
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
