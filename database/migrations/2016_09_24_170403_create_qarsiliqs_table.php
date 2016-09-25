<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQarsiliqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qarsiliqs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('elan_id')->unsigned();
            $table->foreign('elan_id')->references('id')->on('els');
            $table->text('about');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qarsiliqs');
    }
}
