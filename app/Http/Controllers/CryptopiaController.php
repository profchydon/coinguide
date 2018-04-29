<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\CryptopiaRepository;

class CryptopiaController extends Controller
{
    //
    protected $cryptopia;

    public function __construct(CryptopiaRepository $cryptopia)
    {
        $this->cryptopia = $cryptopia;

        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    }

    public function getCoins ()
    {

        $coins = $this->cryptopia->getCoins();

        return $coins['Data'];

    }

    public function saveCoins ()
    {

        $coins = $this->getCoins();

        foreach ($coins as $key => $coin) {

            if ($coin['Status'] == "OK" && $coin['BaseSymbol'] == "BTC") {

              $coin_name = $coin['Currency'];
              $symbol = $coin['Symbol'];
              $currencypair = $coin['Label'];

              $this->cryptopia->saveData ($coin_name, $symbol, $currencypair);

            }

        }

    }

    public function getcurrencyPair ()
    {
        return $this->cryptopia->getAllCurrencyPair();
    }

    public function getMarketHistory ()
    {

        $currencypair = $this->getcurrencyPair();

        // echo "<pre>";
        //
        // var_dump($currencypair);
        // dd();

        $total_buy_trade = 0;

        foreach ($currencypair as $key => $pair) {

            $currencypair = $pair['symbol']."_BTC";

            if (!empty($currencypair)) {

              $trades = $this->cryptopia->getBuy ($currencypair);

              $trades = $trades['Data'];

              $buy = 0;

              foreach ($trades as $key => $trade) {

                  if ($trade['Type'] == "Buy") {

                      $buy = $buy + 1;

                  }

              }

              $update = $this->cryptopia->updateBuy ($pair['symbol'] , $buy);
              $total_buy_trade = $total_buy_trade + $buy;

            }

        }

        $update_total_buy = $this->cryptopia->updateTotalBuy ($total_buy_trade);

    }

    public function viewMarket ()
    {

        $data['cryptopia'] = $this->cryptopia->getAllByLimit();
        return view ('markets.cryptopia', $data);

    }
}
