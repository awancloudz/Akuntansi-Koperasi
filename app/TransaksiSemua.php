<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSemua extends Model
{
    protected $table = 'transaksi_semua';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'kodetransaksi',
        'id_akun',
    	'tanggal',
    	'nominal',    	
    	'keterangan',
        'id_users',
        'status',
    	'created_at',
        'updated_at'
    ];

    //One to Many DARI <-
    public function user(){
        return $this->belongsTo('App\User', 'id_users');
    }
    public function akun(){
        return $this->belongsTo('App\Akun', 'id_akun');
    }
}
