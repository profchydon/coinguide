<?php

namespace App\Http\Repositories;

use App\Cryptopia;

class CryptopiaRepository
{

  protected $cryptopia;

  public function __construct(Cryptopia $cryptopia)
  {
      $this->cryptopia = $cryptopia;
  }

  /**
     * Fetches all coins from cryptopia via the endpoint /GetTradePairs
     * @param
     * @return array $coins
  */
  public function getCoins ()
  {

    $coins = file_get_contents('https://www.cryptopia.co.nz/api/GetTradePairs');

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
  public function getBuy ($currencypair) {

    $buy = file_get_contents('https://www.cryptopia.co.nz/api/GetMarketHistory/'.$currencypair.'/100');

    // Convert JSOn resource to object
    $buy = json_decode($buy);

    // Convert object to array
    $buy = json_decode(json_encode($buy) , TRUE);

    return $buy;

}

  public function saveData ($coin, $symbol, $currencypair) {

      $save = Cryptopia::create([

            'coin' => $coin,
            'symbol' => $symbol,
            'currencypair' => $currencypair

        ]);

        return $save ? true : false;

  }


  public function getAllCurrencyPair ()
  {

       $all = Cryptopia::select('currencypair')->get();
       return json_decode(json_encode($all) , TRUE);

  }

  public function updateBuy ($currencypair, $buy)
  {

    $update = Cryptopia::where('currencypair', $currencypair)->update(['buy' => $buy]);
    return $update ? true : false;

  }


  public function updateTotalBuy ($total_buy_trade)
  {

    $update = Cryptopia::update(['total_buy_trade' => $total_buy_trade]);
    return $update ? true : false;

  }

  public function getAllByLimit ()
  {

      $all = Cryptopia::get();
      return json_decode(json_encode($all) , TRUE);

  }

}
