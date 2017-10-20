<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KeanggotaanRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_keanggotaan' => 'required|string|max:50',
            'simpanan_pokok' => 'required|numeric',
            'simpanan_wajib' => 'required|numeric',
            'bunga_simpanan' => 'required|between:0,99.99',
            'bunga_pinjaman' => 'required|between:0,99.99',
            'denda_pinjaman' => 'required|between:0,99.99',
        ];
    }
}
