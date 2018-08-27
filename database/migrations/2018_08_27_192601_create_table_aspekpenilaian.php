<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAspekpenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspekpenilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_aspekpenilaian',50);
            $table->timestamps();
        });
        Schema::table('komponenpenilaian', function(Blueprint $table) {
            $table->foreign('id_aspekpenilaian')
                ->references('id')
                ->on('aspekpenilaian')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('detailpenilaian', function(Blueprint $table) {
            $table->foreign('id_aspekpenilaian')
                ->references('id')
                ->on('aspekpenilaian')
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
        Schema::table('komponenpenilaian', function(Blueprint $table) {
            $table->dropForeign('komponenpenilaian_id_aspekpenilaian_foreign');
        });
        Schema::table('detailpenilaian', function(Blueprint $table) {
            $table->dropForeign('detailpenilaiann_id_aspekpenilaian_foreign');
        });
        Schema::drop('aspekpenilaian');
    }
}
