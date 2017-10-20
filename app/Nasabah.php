<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $table = 'nasabah';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'no_nasabah',
    	'nama',
    	'alamat',
    	'no_hp',
    	'id_keanggotaan',
    	'tanggal_masuk',
    	'id_users',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function transaksisimpanan(){
        return $this->hasMany('App\TransaksiSimpanan', 'id_nasabah');
    }
    public function transaksipinjaman(){
        return $this->hasMany('App\TransaksiPinjaman', 'id_nasabah');
    }
    //One to Many DARI <-
    public function user(){
        return $this->belongsTo('App\User', 'id_users');
    }
    public function keanggotaan(){
        return $this->belongsTo('App\Keanggotaan', 'id_keanggotaan');
    }
}
