<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekPenilaian extends Model
{
    protected $table = 'aspekpenilaian';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'nama_aspekpenilaian',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function komponenpenilaian(){
        return $this->hasMany('App\KomponenPenilaian', 'id_aspekpenilaian');
    }
    public function detailpenilaian(){
        return $this->hasMany('App\DetailPenilaian', 'id_aspekpenilaian');
    }
}
