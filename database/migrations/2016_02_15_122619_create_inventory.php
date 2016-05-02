<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id');
            $table->string('school');
            $table->string('sku');
            $table->double('price');
            $table->integer('stocks');
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
        Schema::drop('inventory');
    }
}
