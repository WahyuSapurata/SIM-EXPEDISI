<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenawaranRequest;
use App\Http\Requests\UpdatePenawaranRequest;
use App\Models\Penawaran;
use Illuminate\Support\Facades\DB;

class PenawaranController extends BaseController
{
    public function index()
    {
        $module = 'Penawaran';
        return view('admin.penawaran.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $dataFull = Penawaran::all();

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($dataFull, 'Get data success');
    }

    public function store(StorePenawaranRequest $storePenawaranRequest)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storePenawaranRequest->harga);
        $data = array();
        try {
            // Buat format tanggal saat ini
            $year = date('Y');
            $month = date('n'); // bulan dalam bentuk angka tanpa leading zero
            $romanMonth = $this->convertToRoman($month); // fungsi konversi angka ke romawi

            // Ambil nomor invoice terakhir untuk bulan dan tahun ini
            $lastInvoice = DB::table('penawarans')
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
            $newInvoiceNumber = "No.DUALIMA/$newNumber-$storePenawaranRequest->kode_barang/$romanMonth/$year";

            $data = new Penawaran();
            $data->nama_costumer = $storePenawaranRequest->nama_costumer;
            $data->alamat = $storePenawaranRequest->alamat;
            $data->no_surat = $newInvoiceNumber;
            $data->perihal = $storePenawaranRequest->perihal;
            $data->jenis_barang = $storePenawaranRequest->jenis_barang;
            $data->jumlah = $storePenawaranRequest->jumlah;
            $data->kondisi = $storePenawaranRequest->kondisi;
            $data->lokasi_muat = $storePenawaranRequest->lokasi_muat;
            $data->lokasi_tujuan = $storePenawaranRequest->lokasi_tujuan;
            $data->harga = $numericValue;
            $data->pembayaran = $storePenawaranRequest->pembayaran;
            $data->lokasi = $storePenawaranRequest->lokasi;
            $data->tanggal = $storePenawaranRequest->tanggal;
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
            $data = Penawaran::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StorePenawaranRequest $storePenawaranRequest, $params)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storePenawaranRequest->harga);
        try {
            $data = Penawaran::where('uuid', $params)->first();
            $data->nama_costumer = $storePenawaranRequest->nama_costumer;
            $data->alamat = $storePenawaranRequest->alamat;
            $data->no_surat = $storePenawaranRequest->no_surat;
            $data->perihal = $storePenawaranRequest->perihal;
            $data->jenis_barang = $storePenawaranRequest->jenis_barang;
            $data->jumlah = $storePenawaranRequest->jumlah;
            $data->kondisi = $storePenawaranRequest->kondisi;
            $data->lokasi_muat = $storePenawaranRequest->lokasi_muat;
            $data->lokasi_tujuan = $storePenawaranRequest->lokasi_tujuan;
            $data->harga = $numericValue;
            $data->pembayaran = $storePenawaranRequest->pembayaran;
            $data->lokasi = $storePenawaranRequest->lokasi;
            $data->tanggal = $storePenawaranRequest->tanggal;
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
            $data = Penawaran::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }

    public function print($params)
    {
        $penawaran = Penawaran::where('uuid', $params)->first();
        return view('pdf.penawaran', compact('penawaran'))->render();
    }
}
