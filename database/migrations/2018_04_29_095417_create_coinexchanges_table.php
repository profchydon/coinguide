<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinexchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinexchanges', function (Blueprint $table) {
          $table->increments('id');
          $table->string('coin');
          $table->string('market_id');
          $table->string('currencypair');
          $table->integer('buy');
          $table->integer('total_buy_trade');
          $table->integer('current_buy');
          $table->integer('last_total_buy_trade');
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
        Schema::dropIfExists('coinexchanges');
    }
}
