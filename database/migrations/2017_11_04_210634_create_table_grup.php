<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGrup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grup', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_grup',50);
            $table->timestamps();
        });
        Schema::table('header', function(Blueprint $table) {
            $table->foreign('id_grup')
                ->references('id')
                ->on('grup')
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
        Schema::table('header', function(Blueprint $table) {
            $table->dropForeign('header_id_grup_foreign');
        });
        Schema::drop('grup');
    }
}
