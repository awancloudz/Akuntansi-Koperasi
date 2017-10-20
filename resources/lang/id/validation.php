<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => 'The :attribute does not match the format :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => 'The :attribute must be a valid email address.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'The :attribute must be an integer.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        //Header
        'kode_header' => [
            'required' => 'Kode Header Wajib Diisi',
            'max' => 'Kode Header maksimum 50 karakter',
            'unique' => 'Kode Header sudah ada',
        ],
        'nama_header' => [
            'required' => 'Nama Header Wajib Diisi',
            'max' => 'Nama Header maksimum 50 karakter',
        ],

        //Akun
        'kode_akun' => [
            'required' => 'Kode Akun Wajib Diisi',
            'max' => 'Kode Akun maksimum 50 karakter',
            'unique' => 'Kode Akun sudah ada',
        ],
        'nama_akun' => [
            'required' => 'Nama Akun Wajib Diisi',
            'max' => 'Nama Akun maksimum 50 karakter',
        ],
        'id_header' => [
            'required' => 'Header Wajib dipilih',
        ],

        //Keanggotaan
        'nama_keanggotaan' => [
            'required' => 'Nama Keanggotaan Wajib Diisi',
            'max' => 'Nama Keanggotaan maksimum 50 karakter',
        ],
        'simpanan_pokok' => [
            'required' => 'Simpanan Pokok Wajib diisi',
            'numeric' => 'Harus diisi angka',
        ],
        'simpanan_wajib' => [
            'required' => 'Simpanan Wajib harus diisi',
            'numeric' => 'Harus diisi angka 0 - 100',
        ],
        'bunga_simpanan' => [
            'required' => 'Bunga Simpanan Wajib diisi',
            'between' => 'Harus diisi angka 0 - 100',
        ],
        'bunga_pinjaman' => [
            'required' => 'Bunga Pinjaman Wajib diisi',
            'between' => 'Harus diisi angka 0 - 100',
        ],
        'denda_pinjaman' => [
            'required' => 'Denda Pinjaman Wajib diisi',
            'between' => 'Harus diisi angka 0 - 100',
        ],

        //Nasabah
        'no_nasabah' => [
            'required' => 'No.Nasabah Wajib Diisi',
            'max' => 'No.Nasabah maksimum 50 karakter',
            'unique' => 'No.Nasabah Sudah ada',
        ],
        'nama' => [
            'required' => 'Nama Nasabah Wajib Diisi',
            'max' => 'Nama Nasabah maksimum 50 karakter',
        ],
        'alamat' => [
            'required' => 'Alamat Wajib Diisi',
        ],
        'no_hp' => [
            'required' => 'No.HP Wajib Diisi',
            'max' => 'No.HP maksimum 20 karakter',
        ],
        'tanggal_masuk' => [
            'required' => 'Tanggal Masuk Wajib Diisi',
            'date' => 'Format harus tanggal',
        ],
        'id_keanggotaan' => [
            'required' => 'Keanggotaan Wajib dipilih',
        ],

        //Transaksi Simpanan
        'id_akun' => [
            'required' => 'Akun Wajib dipilih',
        ],
        'id_nasabah' => [
            'required' => 'Nasabah Wajib dipilih',
        ],
        'tanggal' => [
            'required' => 'Tanggal Transaksi Wajib Diisi',
            'date' => 'Format harus tanggal',
        ],
        'jenis_simpanan' => [
            'required' => 'Jenis simpanan Wajib Diisi',
            'in' => 'Harus dipilih salah satu',
        ],
        'nominal_simpan' => [
            'required' => 'Nominal Wajib Diisi',
            'numeric' => 'Harus angka',
        ],
        //Transaksi pinjaman
        'nominal_pinjam' => [
            'required' => 'Nominal Pinjam Wajib Diisi',
            'numeric' => 'Harus angka',
        ],
        'kali_angsuran' => [
            'required' => 'Angsuran Wajib Diisi',
            'numeric' => 'Harus angka',
        ],
        'nominal_angsuran' => [
            'required' => 'Nominal Angsuran Wajib Diisi',
            'numeric' => 'Harus angka',
        ],
        'nominal' => [
            'required' => 'Nominal Transaksi Wajib Diisi',
            'numeric' => 'Harus angka',
        ],
        'kodetransaksi' => [
            'required' => 'Kode Transaksi Wajib Diisi',
            'max' => 'Kode Transaksi maksimum 50 karakter',
            'unique' => 'Kode Transaksi Sudah ada',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
