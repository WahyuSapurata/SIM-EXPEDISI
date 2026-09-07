<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenawaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_costumer' => 'required',
            'alamat' => 'required',
            'kode_barang' => 'required',
            'perihal' => 'required',
            'jenis_barang' => 'required',
            'jumlah' => 'required',
            'kondisi' => 'required',
            'lokasi_muat' => 'required',
            'lokasi_tujuan' => 'required',
            'harga' => 'required',
            'pembayaran' => 'required',
            'lokasi' => 'required',
            'tanggal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_costumer.required' => 'Kolom nama costumer harus di isi.',
            'alamat.required' => 'Kolom alamat harus di isi.',
            'kode_barang.required' => 'Kolom kode barang harus di isi.',
            'perihal.required' => 'Kolom perihal harus di isi.',
            'jenis_barang.required' => 'Kolom jenis barang harus di isi.',
            'jumlah.required' => 'Kolom jumlah harus di isi.',
            'kondisi.required' => 'Kolom kondisi pengiriman harus di isi.',
            'lokasi_muat.required' => 'Kolom lokasi muat harus di isi.',
            'lokasi_tujuan.required' => 'Kolom lokasi tujuan harus di isi.',
            'harga.required' => 'Kolom harga harus di isi.',
            'pembayaran.required' => 'Kolom pembayaran harus di isi.',
            'lokasi.required' => 'Kolom lokasi pembuatan surat harus di isi.',
            'tanggal.required' => 'Kolom tanggal pembuatan surat harus di isi.',
        ];
    }
}
