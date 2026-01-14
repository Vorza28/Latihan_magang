<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePembayaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bulan'         => ['required', 'integer', 'min:1', 'max:12'],
            'tahun'         => ['required', 'digits:4'],
            'jumlah_bayar'  => ['required', 'integer', 'min:0'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status'        => ['required', Rule::in(['lunas', 'belum'])],
            'keterangan'    => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'bulan'        => $this->bulan !== null ? (int) $this->bulan : null,
            'tahun'        => $this->tahun !== null ? (int) $this->tahun : null,
            'jumlah_bayar' => $this->jumlah_bayar !== null ? (int) $this->jumlah_bayar : null,
        ]);
    }
}
