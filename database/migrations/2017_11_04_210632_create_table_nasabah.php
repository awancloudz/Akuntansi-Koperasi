<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNasabah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_nasabah')->unique();
            $table->string('nama');    
            $table->text('alamat');
            $table->string('no_hp');
            $table->integer('id_keanggotaan')->unsigned();   
            $table->date('tanggal_masuk');
            $table->integer('id_users')->unsigned();     
            $table->timestamps();
        });
        Schema::table('transaksi_simpanan', function(Blueprint $table) {
            $table->foreign('id_nasabah')
                ->references('id')
                ->on('nasabah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_pinjaman', function(Blueprint $table) {
            $table->foreign('id_nasabah')
                ->references('id')
                ->on('nasabah')
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
        Schema::table('transaksi_simpanan', function(Blueprint $table) {
            $table->dropForeign('transaksi_simpanan_id_nasabah_foreign');
        });
        Schema::table('transaksi_pinjaman', function(Blueprint $table) {
            $table->dropForeign('transaksi_pinjaman_id_nasabah_foreign');
        });
        Schema::drop('nasabah');
    }
}
