<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJurnalUmum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_umum', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodetransaksi',50)->unique();
            $table->date('tanggal');
            $table->double('nominal_total');
            $table->text('keterangan');
            $table->integer('id_users')->unsigned();
            $table->timestamps();
        });
        Schema::table('transaksi_semua', function(Blueprint $table) {
            $table->foreign('id_jurnal_umum')
                ->references('id')
                ->on('jurnal_umum')
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
            $table->dropForeign('transaksi_semua_id_jurnal_umum_foreign');
        });
        Schema::drop('jurnal_umum');
    }
}
