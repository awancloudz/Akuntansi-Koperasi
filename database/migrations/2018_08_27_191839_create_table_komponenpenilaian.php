<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKomponenpenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komponenpenilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_aspekpenilaian')->unsigned();
            $table->string('komponen');
            $table->double('bobot');
            $table->timestamps();
        });
        Schema::table('detailpenilaian', function(Blueprint $table) {
            $table->foreign('id_komponenpenilaian')
                ->references('id')
                ->on('komponenpenilaian')
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
        Schema::table('detailpenilaian', function(Blueprint $table) {
            $table->dropForeign('detailpenilaian_id_komponenpenilaian_foreign');
        });
        Schema::drop('komponenpenilaian');
    }
}
