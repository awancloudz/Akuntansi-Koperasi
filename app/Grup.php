<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    protected $table = 'grup';

    //Hanya jika semua data disimpan tanpa seleksi
    protected $fillable = [
    	'nama_grup',
    	'created_at',
        'updated_at'
    ];

    //One to Many KE ->
    public function header(){
        return $this->hasMany('App\Header', 'id_grup');
    }
}
