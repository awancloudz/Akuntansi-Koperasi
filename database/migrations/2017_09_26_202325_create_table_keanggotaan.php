<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKeanggotaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keanggotaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_keanggotaan');
            $table->double('simpanan_pokok');
            $table->double('simpanan_wajib');
            $table->double('bunga_simpanan');
            $table->double('bunga_pinjaman');
            $table->double('denda_pinjaman');
            $table->string('keterangan');
            $table->integer('id_users')->unsigned();
            $table->timestamps();
        });
        Schema::table('nasabah', function(Blueprint $table) {
            $table->foreign('id_keanggotaan')
                ->references('id')
                ->on('keanggotaan')
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
        Schema::table('nasabah', function(Blueprint $table) {
            $table->dropForeign('nasabah_id_keanggotaan_foreign');
        });
        Schema::drop('keanggotaan');
    }
}
