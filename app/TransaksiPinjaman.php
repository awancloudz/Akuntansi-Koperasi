<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPinjaman extends Model
{
    protected $table = 'transaksi_pinjaman';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'kodetransaksi',
    	'id_akun',
    	'id_nasabah',
    	'tanggal',
    	'nominal_pinjam',
    	'kali_angsuran',
    	'nominal_angsuran',
    	'id_users',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function detailangsuran(){
        return $this->hasMany('App\DetailAngsuran', 'id_transaksi_pinjaman');
    }    
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
