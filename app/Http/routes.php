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

    //DATA MASTER
    Route::resource('header','HeaderController');
    Route::get('akun/cari','AkunController@cari');
    Route::resource('akun','AkunController');
    Route::post('importExcel', 'AkunController@importExcel');
    Route::resource('keanggotaan','KeanggotaanController');
    Route::resource('aspekgrup','AspekController');
    Route::resource('kuesioner','KuesionerController');
    Route::resource('aspekpenilaian','AspekPenilaianController');
    Route::resource('komponenpenilaian','KomponenPenilaianController');
    //NASABAH
    Route::get('nasabah/cari','NasabahController@cari');
    Route::resource('nasabah','NasabahController');
    Route::get('nasabah/simpanan/{nasabah}','NasabahController@simpanan');
    Route::get('nasabah/cetaksimpanan/{nasabah}',[
    'uses' => 'NasabahController@getPdf',
    'as' => 'nasabah.printsimpanan',]);
    Route::get('nasabah/penarikan/{nasabah}','NasabahController@penarikan');
    Route::get('nasabah/pinjaman/{nasabah}','NasabahController@pinjaman');

    //TRANSAKSI
    Route::get('transaksisimpanan/cari','TransaksisimpananController@cari');
    Route::resource('transaksisimpanan','TransaksisimpananController');
    Route::resource('transaksipenarikan','TransaksipenarikanController');
    Route::get('transaksipinjaman/cari','TransaksipinjamanController@cari');
    Route::resource('transaksipinjaman','TransaksipinjamanController');
    Route::get('transaksipinjaman/angsuran/{transaksipinjaman}','TransaksipinjamanController@angsuran');
    Route::get('transaksipinjaman/cetakangsuran/{transaksipinjaman}',[
    'uses' => 'TransaksipinjamanController@getPdf',
    'as' => 'transaksipinjaman.printangsuran',]);
    Route::patch('transaksipinjaman/bayar/{angsuran}','TransaksipinjamanController@bayar');
    Route::resource('detailangsuran','DetailangsuranController');
    Route::get('transaksiumum/cari','TransaksiumumController@cari');
    Route::resource('transaksiumum','TransaksiumumController');
    Route::resource('transaksisemua','TransaksisemuaController');   
    
    //LAPORAN
    Route::get('jurnalumum/cari','JurnalUmumController@cari');
    Route::get('jurnalumum','JurnalUmumController@index');
    Route::get('jurnalumum/cetak',[
    'uses' => 'JurnalUmumController@getPdf',
    'as' => 'jurnalumum.cetak',]);
    Route::get('lapsimpanan/cari','LaporanController@carisimpanan');
    Route::get('lapsimpanan','LaporanController@simpanan');
    Route::get('lapsimpanan/cetak',[
    'uses' => 'LaporanController@getPdf_simpanan',
    'as' => 'laporan.cetaksimpanan',]);
    Route::get('lappinjaman/cari','LaporanController@caripinjaman');
    Route::get('lappinjaman','LaporanController@pinjaman');
    Route::get('lappinjaman/cetak',[
    'uses' => 'LaporanController@getPdf_pinjaman',
    'as' => 'laporan.cetakpinjaman',]);
    Route::get('lapumum/cari','LaporanController@cariumum');
    Route::get('lapumum','LaporanController@umum');
    Route::get('lapumum/cetak',[
    'uses' => 'LaporanController@getPdf_umum',
    'as' => 'laporan.cetakumum',]);
    Route::get('shu/cari','LaporanController@carishu');
    Route::get('shu','LaporanController@shu');
    Route::get('shu/cetak',[
    'uses' => 'LaporanController@getPdf_shu',
    'as' => 'laporan.cetakshu',]);
    Route::get('aruskas/cari','LaporanController@cariaruskas');
    Route::get('aruskas','LaporanController@aruskas');
    Route::get('aruskas/cetak',[
    'uses' => 'LaporanController@getPdf_aruskas',
    'as' => 'laporan.cetakaruskas',]);
    Route::get('neraca/cari','LaporanController@carineraca');
    Route::get('neraca','LaporanController@neraca');
    Route::get('neraca/cetak',[
    'uses' => 'LaporanController@getPdf_neraca',
    'as' => 'laporan.cetakaneraca',]);
    Route::resource('nilaikuesioner','NilaiKuesionerController');
    Route::resource('kesehatankoperasi','KesehatanKoperasiController');
    //Admin
    Route::get('penilaiankesehatan','KesehatanKoperasiController@indexadmin');
    Route::get('penilaiankesehatan/{user}','KesehatanKoperasiController@showadmin');
});




