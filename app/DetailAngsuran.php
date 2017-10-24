<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailAngsuran extends Model
{
    protected $table = 'detail_angsuran';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'id_transaksi_pinjaman',
    	'angsuran',
    	'jasa_uang',
    	'total_bayar',
    	'saldo',
    	'jatuh_tempo',
        'tanggal_bayar',
        'status_bayar',
    	'created_at',
        'updated_at'
    ];

    //One to Many DARI <-    
    public function detailangsuran(){
        return $this->belongsTo('App\DetailAngsuran', 'id_transaksi_pinjaman');
    }    
}
