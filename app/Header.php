<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'header';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'id_grup',
    	'kode_header',
        'nama_header',      	
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function akun(){
        return $this->hasMany('App\Akun', 'id_header');
    }
    //One to Many DARI <-
    public function grup(){
        return $this->belongsTo('App\Grup', 'id_grup');
    }
}
