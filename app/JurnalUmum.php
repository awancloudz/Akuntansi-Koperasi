<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JurnalUmum extends Model
{
    protected $table = 'jurnalumum';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'keterangan',  	
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function transaksi_semua(){
        return $this->hasMany('App\TransaksiSemua', 'id_jurnalumum');
    }
}
