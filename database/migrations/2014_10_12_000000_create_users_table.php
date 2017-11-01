<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('no_badan_hukum');
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        Schema::table('keanggotaan', function(Blueprint $table) {
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('nasabah', function(Blueprint $table) {
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_simpanan', function(Blueprint $table) {
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_pinjaman', function(Blueprint $table) {
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_umum', function(Blueprint $table) {
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->foreign('id_users')
                ->references('id')
                ->on('users')
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
        Schema::table('keanggotaan', function(Blueprint $table) {
            $table->dropForeign('keanggotaan_id_users_foreign');
        });
        Schema::table('nasabah', function(Blueprint $table) {
            $table->dropForeign('nasabah_id_users_foreign');
        });
        Schema::table('transaksi_simpanan', function(Blueprint $table) {
            $table->dropForeign('transaksi_simpanan_id_users_foreign');
        });
        Schema::table('transaksi_pinjaman', function(Blueprint $table) {
            $table->dropForeign('transaksi_pinjaman_id_users_foreign');
        });
        Schema::table('transaksi_umum', function(Blueprint $table) {
            $table->dropForeign('transaksi_umum_id_users_foreign');
        });
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->dropForeign('transaksi_semua_id_users_foreign');
        });
        Schema::drop('users');
    }
}
