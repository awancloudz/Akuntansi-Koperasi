<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAkun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_header')->unsigned();
            $table->string('kode_akun');
            $table->string('nama_akun');
            $table->timestamps();
        });
        Schema::table('transaksi_simpanan', function(Blueprint $table) {
            $table->foreign('id_akun')
                ->references('id')
                ->on('akun')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_pinjaman', function(Blueprint $table) {
            $table->foreign('id_akun')
                ->references('id')
                ->on('akun')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_umum', function(Blueprint $table) {
            $table->foreign('id_akun')
                ->references('id')
                ->on('akun')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->foreign('id_akun')
                ->references('id')
                ->on('akun')
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
            $table->dropForeign('transaksi_simpanan_id_akun_foreign');
        });
        Schema::table('transaksi_pinjaman', function(Blueprint $table) {
            $table->dropForeign('transaksi_pinjaman_id_akun_foreign');
        });
        Schema::table('transaksi_umum', function(Blueprint $table) {
            $table->dropForeign('transaksi_umum_id_akun_foreign');
        });
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->dropForeign('transaksi_semua_id_akun_foreign');
        });
        Schema::drop('akun');
    }
}
