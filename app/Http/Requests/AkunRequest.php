<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AkunRequest extends Request
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
        if ($this->method() == 'PATCH'){
        $kodeakun_rules = 'required|string|max:50|unique:akun,kode_akun,' . $this->get('id');
        }
        else{
        $kodeakun_rules = 'required|string|max:50|unique:akun,kode_akun';
        }
        return [
            'kode_akun' => $kodeakun_rules,
            'id_header' => 'required',
            'nama_akun' => 'required|string|max:50',
        ];
    }
}
