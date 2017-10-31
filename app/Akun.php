<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = 'akun';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'id_header',
    	'kode_akun',
    	'nama_akun',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function transaksisimpanan(){
        return $this->hasMany('App\TransaksiSimpanan', 'id_akun');
    }
    public function transaksipinjaman(){
        return $this->hasMany('App\TransaksiPinjaman', 'id_akun');
    }
    public function transaksiutama(){
        return $this->hasMany('App\TransaksiUtama', 'id_akun');
    }
    public function transaksisemua(){
        return $this->hasMany('App\TransaksiSemua', 'id_akun');
    }
    //One to Many DARI <-
    public function header(){
        return $this->belongsTo('App\Header', 'id_header');
    }
}
