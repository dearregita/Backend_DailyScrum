<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dailyscrum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dailyscrum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_users');
            $table->enum('team', array( 'DDS','BEON','DOT','node1','node2','react1','react2','laravel','laravel_vue','android'))->default('DDS');
            $table->string('activity_yesterday');
            $table->string('activity_today');
            $table->string('problem_yesterday');
            $table->string('solution');
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
        Schema::dropIfExists('dailyscrum');
    }
}
