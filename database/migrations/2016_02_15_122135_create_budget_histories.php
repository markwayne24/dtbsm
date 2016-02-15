<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budge_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('action');
            $table->double('amount');
            $table->date('budget_year');
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
        Schema::drop('budge_histories');
    }
}
