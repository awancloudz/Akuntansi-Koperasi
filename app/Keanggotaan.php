<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keanggotaan extends Model
{
    protected $table = 'keanggotaan';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'nama_keanggotaan',
    	'simpanan_pokok',
    	'simpanan_wajib',
    	'bunga_simpanan',
    	'bunga_pinjaman',
    	'denda_pinjaman',
    	'keterangan',
    	'id_users',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function nasabah(){
        return $this->hasMany('App\Nasabah', 'id_keanggotaan');
    }
    //One to Many DARI <-
    public function user(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
