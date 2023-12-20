<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'nama' => 'required|string|max:100',
            'nik' => 'required|numeric|unique:penduduks',
            'telpon' => 'required|numeric',
            'alamat' => 'required|string',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'provinsi_id' => 'required|numeric',
            'kabupaten_id' => 'required|numeric',
            'kecamatan_id' => 'required|numeric',
            'kelurahan_id' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'nik.required' => 'NIK harus diisi.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'telpon.required' => 'No. HP harus diisi.',
            'telpon.numeric' => 'No. HP harus berupa angka.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus diisi.',
            'rt.required' => 'RT harus diisi.',
            'rt.numeric' => 'RT harus berupa angka.',
            'rw.required' => 'RW harus diisi.',
            'rw.numeric' => 'RW harus berupa angka.',
            'provinsi_id.required' => 'Provinsi harus diisi.',
            'kabupaten_id.required' => 'Kabupaten harus diisi.',
            'kecamatan_id.required' => 'Kecamatan harus diisi.',
            'kelurahan_id.required' => 'Kelurahan harus diisi.',
        ];
    }

}
