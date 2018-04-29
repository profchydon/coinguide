<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptopia extends Model
{
    //
    protected $fillable = [
      'id', 'coin', 'symbol', 'currencypair', 'buy', 'total_buy_trade', 'current_buy', 'last_total_buy_trade' , 'change'
    ];
}
