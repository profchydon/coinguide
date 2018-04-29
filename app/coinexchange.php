<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coinexchange extends Model
{
    //
    protected $fillable = [
      'id', 'coin', 'market_id', 'currencypair', 'buy', 'total_buy_trade', 'current_buy', 'last_total_buy_trade' , 'change'
    ];
}
