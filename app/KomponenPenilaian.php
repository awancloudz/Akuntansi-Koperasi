<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomponenPenilaian extends Model
{
    protected $table = 'komponenpenilaian';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'id_aspekpenilaian',
        'komponen', 
        'bobot',
    	  'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function detailpenilaian(){
        return $this->hasMany('App\DetailPenilaian', 'id_komponenpenilaian');
    }
    //One to Many DARI <-
    public function aspekpenilaian(){
        return $this->belongsTo('App\AspekPenilaian', 'id_aspekpenilaian');
    }
}
