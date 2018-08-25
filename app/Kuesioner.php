<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuesioner extends Model
{
    protected $table = 'kuesioner';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'id_aspekgrup',
        'deskripsi',      	
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function nilaikuesioner(){
        return $this->hasMany('App\NilaiKuesioner', 'id_kuesioner');
    }
    //One to Many DARI <-
    public function aspekgrup(){
        return $this->belongsTo('App\AspekGrup', 'id_aspekgrup');
    }
}
