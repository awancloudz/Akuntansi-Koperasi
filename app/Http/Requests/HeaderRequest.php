<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HeaderRequest extends Request
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
        $kodeheader_rules = 'required|string|max:50|unique:header,kode_header,' . $this->get('id');
        }
        else{
        $kodeheader_rules = 'required|string|max:50|unique:header,kode_header';
        }
        return [
            'kode_header' => $kodeheader_rules,
            'nama_header' => 'required|string|max:50',
        ];
    }
}
