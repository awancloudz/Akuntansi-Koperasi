<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransaksiUmumRequest extends Request
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
        $kodetransaksi_rules = 'required|string|max:50|unique:transaksi_umum,kodetransaksi,' . $this->get('id');
        }
        else{
        $kodetransaksi_rules = 'required|string|max:50|unique:transaksi_umum,kodetransaksi';
        }
        return [
            'kodetransaksi' => $kodetransaksi_rules,
            'id_akun' => 'required',
            'tanggal' => 'required|date',
            'nominal' => 'required|numeric',
            'status' => 'required',
        ];
    }
}
