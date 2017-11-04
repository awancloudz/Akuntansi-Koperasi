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
        //TRANSAKSI
        if(Request::segment(1) == 'transaksisimpanan'){
            $halaman = 'transaksisimpanan';
        }
        if(Request::segment(1) == 'transaksipenarikan'){
            $halaman = 'transaksipenarikan';
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

        //LAPORAN
        if(Request::segment(1) == 'jurnalumum'){
            $halaman = 'jurnalumum';
        }
        if(Request::segment(1) == 'lapsimpanan'){
            $halaman = 'lapsimpanan';
        }
        if(Request::segment(1) == 'lappinjaman'){
            $halaman = 'lappinjaman';
        }
        if(Request::segment(1) == 'lapumum'){
            $halaman = 'lapumum';
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
