<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request;

class LaravelAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //MASTER
        $halaman = '';
        if(Request::segment(1) == 'header'){
            $halaman = 'header';
        }
        if(Request::segment(1) == 'akun'){
            $halaman = 'akun';
        }
        if(Request::segment(1) == 'user'){
            $halaman = 'user';
        }
        if(Request::segment(1) == 'keanggotaan'){
            $halaman = 'keanggotaan';
        }
        if(Request::segment(1) == 'transaksisimpanan'){
            $halaman = 'transaksisimpanan';
        }
        if(Request::segment(1) == 'transaksipinjaman'){
            $halaman = 'transaksipinjaman';
        }
        if(Request::segment(1) == 'transaksiumum'){
            $halaman = 'transaksiumum';
        }
        if(Request::segment(1) == 'nasabah'){
            $halaman = 'nasabah';
        }
        if(Request::segment(1) == 'detailangsuran'){
            $halaman = 'detailangsuran';
        }

        view()->share('halaman', $halaman);
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
