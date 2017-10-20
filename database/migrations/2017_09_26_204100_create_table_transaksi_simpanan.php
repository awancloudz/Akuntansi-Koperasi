<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksiSimpanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_simpanan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodetransaksi',50)->unique();
            $table->integer('id_akun')->unsigned();
            $table->integer('id_nasabah')->unsigned();
            $table->date('tanggal');
            $table->enum('jenis_simpanan',['pokok','sukarela']);
            $table->double('nominal_simpan');
            $table->integer('id_users')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaksi_simpanan');
    }
}
