<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','no_badan_hukum','username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //One to Many KE ->
    public function keanggotaan(){
        return $this->hasMany('App\Keanggotaan', 'id_users');
    }
    public function nasabah(){
        return $this->hasMany('App\Nasabah', 'id_users');
    }
    public function transaksisimpanan(){
        return $this->hasMany('App\TransaksiSimpanan', 'id_users');
    }
    public function transaksipinjaman(){
        return $this->hasMany('App\TransaksiPinjaman', 'id_users');
    }
    public function transaksisemua(){
        return $this->hasMany('App\TransaksiSemua', 'id_users');
    }
    public function transaksiutama(){
        return $this->hasMany('App\TransaksiUtama', 'id_users');
    }
    public function nilaikuesioner(){
        return $this->hasMany('App\NilaiKuesioner', 'id_users');
    }
    public function detailpenilaian(){
        return $this->hasMany('App\DetailPenilaian', 'id_users');
    }
}
