<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJurnalumum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnalumum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan');
            $table->timestamps();
        });
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->foreign('id_jurnalumum')
                ->references('id')
                ->on('jurnalumum')
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
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->dropForeign('transaksi_semua_id_jurnalumum_foreign');
        });
        Schema::drop('jurnalumum');
    }
}
