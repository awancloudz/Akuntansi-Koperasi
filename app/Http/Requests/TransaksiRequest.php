<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransaksiRequest extends Request
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
        $kodetransaksi_rules = 'required|string|max:15|unique:transaksi,kodetransaksi,' . $this->get('id');
        }
        else{
        $kodetransaksi_rules = 'required|string|max:15|unique:transaksi,kodetransaksi';
        }
        return [
            'kodetransaksi' => $kodetransaksi_rules,
            'jenistransaksi' => 'required|in:retail,grosir,pesan',
            'tanggaltransaksi' => 'required|date',
        ];
    }
}
