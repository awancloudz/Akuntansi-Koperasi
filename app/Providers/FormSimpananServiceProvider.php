<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Nasabah;
use App\Akun;
use App\TransaksiSimpanan;
use Auth;

class FormSimpananServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('transaksisimpanan.form', function($view){
            if(Auth::check()){
            $iduser = Auth::user()->id;
            }
            $view->with('list_nasabah', Nasabah::where('id_users',$iduser)->lists('nama', 'id'));
            $view->with('list_akun', Akun::lists('nama_akun', 'id'));
        });
        view()->composer('transaksipenarikan.form', function($view){
            if(Auth::check()){
            $iduser = Auth::user()->id;
            }
            $view->with('list_nasabah', Nasabah::where('id_users',$iduser)->lists('nama', 'id'));
            $view->with('list_akun', Akun::lists('nama_akun', 'id'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
