<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTransaksiPinjaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pinjaman', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodetransaksi',50)->unique();
            $table->integer('id_akun')->unsigned();
            $table->integer('id_nasabah')->unsigned();
            $table->date('tanggal');
            $table->double('nominal_pinjam');
            $table->integer('kali_angsuran');
            $table->double('nominal_angsuran');
            $table->integer('id_users')->unsigned();
            $table->timestamps();
        });
        Schema::table('detail_angsuran', function(Blueprint $table) {
            $table->foreign('id_transaksi_pinjaman')
                ->references('id')
                ->on('transaksi_pinjaman')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_angsuran', function(Blueprint $table) {
            $table->dropForeign('detail_angsuran_id_transaksi_pinjaman_foreign');
        });
        Schema::drop('transaksi_pinjaman');
    }
}
