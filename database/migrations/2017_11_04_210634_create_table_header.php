<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('id_grup')->unsigned();
            $table->string('kode_header');
            $table->string('nama_header');
            $table->timestamps();
        });
        Schema::table('akun', function(Blueprint $table) {
            $table->foreign('id_header')
                ->references('id')
                ->on('header')
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
        Schema::table('akun', function(Blueprint $table) {
            $table->dropForeign('akun_id_header_foreign');
        });
        Schema::drop('header');
    }
}
