<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAspekgrup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspekgrup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_aspekgrup',50);
            $table->timestamps();
        });
        Schema::table('kuesioner', function(Blueprint $table) {
            $table->foreign('id_aspekgrup')
                ->references('id')
                ->on('aspekgrup')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('nilaikuesioner', function(Blueprint $table) {
            $table->foreign('id_aspekgrup')
                ->references('id')
                ->on('aspekgrup')
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
        Schema::table('kuesioner', function(Blueprint $table) {
            $table->dropForeign('kuesioner_id_aspekgrup_foreign');
        });
        Schema::table('nilaikuesioner', function(Blueprint $table) {
            $table->dropForeign('nilaikuesioner_id_aspekgrup_foreign');
        });
        Schema::drop('aspekgrup');
    }
}
