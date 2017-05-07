<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCartitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemlists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menuid')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('userid')->references('id')->on('users')->onDelete('cascade');
            $table->integer('vendorid')->references('id')->on('vendors')->onDelete('cascade');
            $table->integer('qty');
            $table->string('startdate');
            $table->string('enddate');
            $table->string('menutype');
            $table->string('timeslot');
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
        Schema::dropIfExists('itemlists');
    }
}
