<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Validator
Route::group(['middleware' => ['web']], function(){
    //Controller Untuk Cek Login
    Route::auth();
    Route::get('/', 'HomeController@index');
    Route::resource('user','UserController');

    Route::resource('header','HeaderController');
    Route::resource('akun','AkunController');
    Route::resource('keanggotaan','KeanggotaanController');
    Route::resource('nasabah','NasabahController');
    Route::get('nasabah/simpanan/{nasabah}','NasabahController@simpanan');
    Route::get('nasabah/pinjaman/{nasabah}','NasabahController@pinjaman');
    Route::resource('transaksisimpanan','TransaksisimpananController');
    Route::resource('transaksipenarikan','TransaksipenarikanController');
    Route::resource('transaksipinjaman','TransaksipinjamanController');
    Route::get('transaksipinjaman/angsuran/{transaksipinjaman}','TransaksipinjamanController@angsuran');
    Route::patch('transaksipinjaman/bayar/{angsuran}','TransaksipinjamanController@bayar');
    Route::resource('detailangsuran','DetailangsuranController');
    Route::resource('transaksiumum','TransaksiumumController');

    //CONTOH
    
    Route::get('nasabah/cari','NasabahController@cari');
    /*Route::get('produk/caribarcode','ProdukController@caribarcode');
    Route::resource('produk','ProdukController');
    Route::get('kategori/{cat}',[
    'uses' => 'ProdukController@kategori',
    'as'   => 'kategori'
    ]);
    Route::get('produk/print/{produk}',[
    'uses' => 'ProdukController@getPdf',
    'as' => 'produk.print',
    ]);
    Route::post('importExcel', 'ProdukController@importExcel');
    Route::get('exportExcel/{type}', 'ProdukController@exportExcel');
    */
});




