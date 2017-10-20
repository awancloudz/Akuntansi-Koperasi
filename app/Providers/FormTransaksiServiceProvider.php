<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Akun;
use App\TransaksiUmum;
//use Auth;

class FormTransaksiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
         view()->composer('transaksiumum.form', function($view){
            /*
            if(Auth::check()){
            $iduser = Auth::user()->id;
            }
            $view->with('list_nasabah', Nasabah::where('id_users',$iduser)->lists('nama', 'id'));
            */
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
