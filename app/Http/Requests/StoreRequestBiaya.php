<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestBiaya extends FormRequest
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
            'tanggal' => 'required',
            'item' => 'required',
            'qty' => 'required',
            'satuan' => 'required',
            'harga' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Kolom tanggal harus di isi.',
            'item.required' => 'Kolom item harus di isi.',
            'qty.required' => 'Kolom qty harus di isi.',
            'satuan.required' => 'Kolom satuan harus di isi.',
            'harga.required' => 'Kolom harga harus di isi.',
        ];
    }
}
