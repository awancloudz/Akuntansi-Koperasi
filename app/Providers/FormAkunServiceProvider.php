<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Grup;
use App\Header;
use App\Akun;

class FormAkunServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header.form', function($view){
            $view->with('list_grup', Grup::lists('nama_grup', 'id'));
        });
        view()->composer('akun.form', function($view){
            $view->with('list_header', Header::lists('nama_header', 'id'));
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
