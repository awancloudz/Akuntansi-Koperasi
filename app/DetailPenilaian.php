<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenilaian extends Model
{
    protected $table = 'detailpenilaian';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
        'id_users',
        'id_aspekpenilaian',
    	  'id_komponenpenilaian',
        'persen',
        'nilaikredit',
        'skor',
    	  'created_at',
        'updated_at'
    ];
    //One to Many DARI <-
    public function aspekpenilaian(){
        return $this->belongsTo('App\AspekPenilaian', 'id_aspekpenilaian');
    }
    public function komponenpenilaian(){
        return $this->belongsTo('App\KomponenPenilaian', 'id_komponenpenilaian');
    }
    public function user(){
        return $this->belongsTo('App\User', 'id_users');
    }
}
