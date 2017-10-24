<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailAngsuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_angsuran', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_transaksi_pinjaman')->unsigned();
            $table->double('angsuran');
            $table->double('jasa_uang');
            $table->double('total_bayar');
            $table->double('saldo');
            $table->date('jatuh_tempo');
            $table->date('tanggal_bayar');
            $table->enum('status_bayar',['belum','sudah']);
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
        Schema::drop('detail_angsuran');
    }
}
