<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePembayaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'siswa_id'      => ['required', 'exists:siswas,id'],
            'bulan'         => ['required', 'integer', 'min:1', 'max:12'],
            'tahun'         => ['required', 'digits:4'],
            'jumlah_bayar'  => ['required', 'integer', 'min:0'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status'        => ['required', Rule::in(['lunas', 'belum'])],
            'keterangan'    => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'siswa_id.required' => 'Siswa wajib dipilih.',
            'siswa_id.exists'   => 'Siswa tidak ditemukan.',
            'bulan.required'    => 'Bulan wajib diisi.',
            'bulan.min'         => 'Bulan minimal 1.',
            'bulan.max'         => 'Bulan maksimal 12.',
            'tahun.digits'      => 'Tahun harus 4 digit.',
            'status.in'         => 'Status harus lunas atau belum.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Biar input string dari form jadi konsisten angka
        $this->merge([
            'bulan'        => $this->bulan !== null ? (int) $this->bulan : null,
            'tahun'        => $this->tahun !== null ? (int) $this->tahun : null,
            'jumlah_bayar' => $this->jumlah_bayar !== null ? (int) $this->jumlah_bayar : null,
        ]);
    }
}
