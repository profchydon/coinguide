<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tradesatoshi extends Model
{
    //

    protected $fillable = [
      'id', 'coin', 'currencypair', 'buy', 'total_buy_trade', 'current_buy', 'last_total_buy_trade' , 'change'
    ];
}
