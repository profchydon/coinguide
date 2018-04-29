<?php

namespace App\Http\Repositories;

use App\Tradesatoshi;

class TradesatoshiRepository
{

  protected $tradesatoshi;

  public function __construct(Tradesatoshi $tradesatoshi)
  {
      $this->tradesatoshi = $tradesatoshi;
  }

  /**
     * Fetches all coins from tradesatoshi via the endpoint /getcurrencies
     * @param
     * @return array $coins
  */
  public function getCoins () {

      $coins = file_get_contents('https://tradesatoshi.com/api/public/getcurrencies');

      // Convert JSOn resource to object
      $coins = json_decode($coins);

      // Convert object to array
      $coins = json_decode(json_encode($coins) , TRUE);

      return $coins['result'];

  }


  /**
     * Fetches market history for each coin from tradesatoshi via the endpoint /getmarkethistory
     * @param $currencypair
     * @return array $coins
  */
  public function getSummary ($currencypair) {

      $coins = file_get_contents('https://tradesatoshi.com/api/public/getmarkethistory?market='.$currencypair.'&count=200');

      // Convert JSOn resource to object
      $coins = json_decode($coins);

      // Convert object to array
      $coins = json_decode(json_encode($coins) , TRUE);

      return $coins;

  }

  public function saveData ($coin, $currencypair) {

      $save = Tradesatoshi::create([

            'coin' => $coin,
            'currencypair' => $currencypair

        ]);

        return $save ? true : false;

  }


  public function updateBuy ($currencypair, $buy)
  {

    $update = Tradesatoshi::where('currencypair', $currencypair)->update(['buy' => $buy]);
    return $update ? true : false;

  }


  public function updateTotalBuy ($total_buy_trade)
  {

    $update = Tradesatoshi::update(['total_buy_trade' => $total_buy_trade]);
    return $update ? true : false;

  }


  public function getAllCurrencyPair ()
  {

       $all = Tradesatoshi::select('currencypair')->get();
       return json_decode(json_encode($all) , TRUE);

  }


  public function getAllByLimit ()
  {

      $all = Tradesatoshi::get();
      return json_decode(json_encode($all) , TRUE);

  }

}
