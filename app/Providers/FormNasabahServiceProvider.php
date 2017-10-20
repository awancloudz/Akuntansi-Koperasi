<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Keanggotaan;
use App\Nasabah;
use Auth;

class FormNasabahServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer('nasabah.form', function($view){
            if(Auth::check()){
            $iduser = Auth::user()->id;
            }
            $view->with('list_keanggotaan', Keanggotaan::where('id_users',$iduser)->lists('nama_keanggotaan', 'id'));
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
