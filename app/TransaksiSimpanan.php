<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiSimpanan extends Model
{
    protected $table = 'transaksi_simpanan';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'kodetransaksi',
    	'id_akun',
    	'id_nasabah',
    	'tanggal',
    	'jenis_simpanan',    	
    	'nominal_simpan',
    	'id_users',
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
    public function nasabah(){
        return $this->belongsTo('App\Nasabah', 'id_nasabah');
    }
}
