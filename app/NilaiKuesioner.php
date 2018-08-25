<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiKuesioner extends Model
{
    protected $table = 'nilaikuesioner';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'id_users',
    	'id_kuesioner',
        'pilihan',
    	'created_at',
        'updated_at'
    ];
    //One to Many DARI <-
    public function kuesioner(){
        return $this->belongsTo('App\Kuesioner', 'id_kuesioner');
    }
    public function user(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
