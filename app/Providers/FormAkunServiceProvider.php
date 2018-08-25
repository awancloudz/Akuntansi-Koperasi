<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Grup;
use App\Header;
use App\Akun;
use App\AspekGrup;
use App\Kuesioner;
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
        view()->composer('kuesioner.form', function($view){
            $view->with('list_aspek', AspekGrup::lists('nama_aspekgrup', 'id'));
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
