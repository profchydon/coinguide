<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GdaxEth extends Model
{
    //
    protected $fillable = [
      'id', 'coin', 'product_id', 'currencypair', 'buy', 'total_buy_trade', 'current_buy', 'last_total_buy_trade'
    ];
}
