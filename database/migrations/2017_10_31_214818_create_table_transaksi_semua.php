<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksiSemua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_semua', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_akun')->unsigned();
            $table->string('kodetransaksi',50)->unique();
            $table->date('tanggal');
            $table->double('nominal');
            $table->text('keterangan');
            $table->integer('id_users')->unsigned();
            $table->enum('status',['debit','kredit']);
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
        Schema::drop('transaksi_semua');
    }
}
