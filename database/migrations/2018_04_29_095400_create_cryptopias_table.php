<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCryptopiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptopias', function (Blueprint $table) {
          $table->increments('id');
          $table->string('coin')->nullable();
          $table->string('symbol')->nullable();
          $table->string('currencypair')->nullable();
          $table->integer('buy')->nullable();
          $table->integer('total_buy_trade')->nullable();
          $table->integer('current_buy')->nullable();
          $table->integer('last_total_buy_trade')->nullable();  
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
        Schema::dropIfExists('cryptopias');
    }
}
