<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRealCostRequest extends FormRequest
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
            'uuid_customer' => 'required',
            'tanggal' => 'required',
            'nama_kapal' => 'required',
            'alamat_pengirim' => 'required',
            'alamat_tujuan' => 'required',
            'muat' => 'required',
            'bongkar' => 'required',
            'delevery' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'uuid_customer.required' => 'Kolom customer harus di isi.',
            'tanggal.required' => 'Kolom tanggal harus di isi.',
            'nama_kapal.required' => 'Kolom nama kapal harus di isi.',
            'alamat_pengirim.required' => 'Kolom alamat pengirim harus di isi.',
            'alamat_tujuan.required' => 'Kolom alamat tujuan harus di isi.',
            'muat.required' => 'Kolom muat harus di isi.',
            'bongkar.required' => 'Kolom bongkar harus di isi.',
            'delevery.required' => 'Kolom delevery harus di isi.',
        ];
    }
}
