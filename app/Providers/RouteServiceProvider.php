<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);
        $router->model('header', 'App\Header');
        $router->model('akun', 'App\Akun');
        $router->model('user', 'App\User');
        $router->model('keanggotaan', 'App\Keanggotaan');
        $router->model('nasabah', 'App\Nasabah');
        $router->model('transaksisimpanan', 'App\TransaksiSimpanan');
        $router->model('transaksipinjaman', 'App\TransaksiPinjaman');
        $router->model('transaksiumum', 'App\TransaksiUmum');
        $router->model('detailangsuran', 'App\DetailAngsuran');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        //$this->mapWebRoutes($router);
        $router->group(['namespace' => $this->namespace], function($router){
            require app_path('Http/routes.php');
        });
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace' => $this->namespace, 'middleware' => 'web',
        ], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
