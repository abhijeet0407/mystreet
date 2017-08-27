<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menuorders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('menu_item');
            $table->string('menu_name');
            $table->string('menu_qty');
            $table->string('menu_type');
            $table->string('menu_plan');
            $table->string('menu_startdate');
            $table->string('menu_deliverytime');
            $table->string('menu_days');
            $table->string('menu_price');
            $table->string('order_price');
            $table->string('customerId');

            $table->softDeletes();
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
        Schema::dropIfExists('menuorders');
    }
}
