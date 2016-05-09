<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id');
            $table->integer('inventory_id');
            $table->integer('quantity');
            $table->double('price');
            $table->enum('status',['Approved','Declined','Pending'])->default('Pending');
            $table->string('reason');
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
        Schema::drop('inventory_requests');
    }
}
