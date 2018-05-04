<?php

namespace App\Http\Repositories;

use App\GdaxEth;

class GdaxEthRepository
{

  protected $gdaxeth;

  public function __construct(GdaxEth $gdaxeth)
  {
      $this->gdaxeth = $gdaxeth;
  }

  /**
     * Fetches all coins from gdax via the endpoint /GetTradePairs
     * @param
     * @return array $coins
  */
  public function getCoins ()
  {

    $coins = file_get_contents('https://api.gdax.com/products');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

  }


  /**
     * Fetches market history for each coin from cryptopia via the endpoint /GetMarketHistory
     * @param $currencypair
     * @return array $buy
  */
  public function getBuy ($currencypair)
  {

    $buy = file_get_contents('https://api.gdax.com//products/'.$currencypair.'/trades');

    // Convert JSOn resource to object
    $buy = json_decode($buy);

    // Convert object to array
    $buy = json_decode(json_encode($buy) , TRUE);

    return $buy;

  }

  public function saveData ($coin, $currencypair) {

      $save = GdaxEth::create([

            'coin' => $coin,
            'currencypair' => $currencypair

        ]);

        return $save ? true : false;

  }


  public function getAllCurrencyPair ()
  {

       $all = GdaxEth::select('currencypair')->get();
       return json_decode(json_encode($all) , TRUE);

  }

  public function updateBuy ($currencypair, $buy)
  {

    $update = GdaxEth::where('currencypair', $currencypair)->update(['buy' => $buy]);
    return $update ? true : false;

  }


  public function updateTotalBuy ($total_buy_trade)
  {

    $update = GdaxEth::update(['total_buy_trade' => $total_buy_trade]);
    return $update ? true : false;

  }

  public function getAllByLimit ()
  {

      $all = GdaxEth::get();
      return json_decode(json_encode($all) , TRUE);

  }

}
