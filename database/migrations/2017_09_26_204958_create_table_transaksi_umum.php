<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksiUmum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_umum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodetransaksi',50)->unique();
            $table->integer('id_akun')->unsigned();
            $table->date('tanggal');
            $table->double('nominal');
            $table->text('keterangan');
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
        Schema::drop('transaksi_umum');
    }
}
