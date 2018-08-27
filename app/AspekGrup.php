<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AspekGrup extends Model
{
    protected $table = 'aspekgrup';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'nama_aspekgrup',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function kuesioner(){
        return $this->hasMany('App\Kuesioner', 'id_aspekgrup');
    }
    public function nilaikuesioner(){
        return $this->hasMany('App\NilaiKuesioner', 'id_aspekgrup');
    }
}
