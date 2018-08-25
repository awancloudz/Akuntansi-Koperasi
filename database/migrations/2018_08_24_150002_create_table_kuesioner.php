<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKuesioner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_aspekgrup')->unsigned();
            $table->string('deskripsi');
            $table->timestamps();
        });
        Schema::table('nilaikuesioner', function(Blueprint $table) {
            $table->foreign('id_kuesioner')
                ->references('id')
                ->on('kuesioner')
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
        Schema::table('nilaikuesioner', function(Blueprint $table) {
            $table->dropForeign('nilaikuesioner_id_kuesioner_foreign');
        });
        Schema::drop('kuesioner');
    }
}
