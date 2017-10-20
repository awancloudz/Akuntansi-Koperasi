<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NasabahRequest extends Request
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
        $nonasabah_rules = 'required|string|max:50|unique:nasabah,no_nasabah,' . $this->get('id');
        }
        else{
        $nonasabah_rules = 'required|string|max:50|unique:nasabah,no_nasabah';
        }
        return [
            'no_nasabah' => $nonasabah_rules,
            'nama' => 'required|string|max:50',
            'alamat' => 'required',
            'no_hp' => 'required|max:20',
            'tanggal_masuk' => 'required|date',
            'id_keanggotaan' => 'required',
        ];
    }
}
