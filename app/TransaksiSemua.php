<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSemua extends Model
{
    protected $table = 'transaksi_semua';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'id_akun',
        'id_jurnalumum',
        'kodetransaksi',
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
    public function jurnalumum(){
        return $this->belongsTo('App\JurnalUmum', 'id_jurnalumum');
    }

}