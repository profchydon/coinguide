<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\GdaxRepository;

class GdaxController extends Controller
{
    //
    protected $gdax;

    public function __construct(GdaxRepository $gdax)
    {
        $this->gdax = $gdax;

    }

    public function getCoins ()
    {

        $coins = $this->gdax->getCoins();

        return $coins;

    }

    public function saveCoins ()
    {

        $coins = $this->getCoins();

        foreach ($coins as $key => $coin) {

            if ($coin['quote_currency'] == "BTC") {

                $coin_name = $coin['base_currency'];
                $currencypair = $coin['id'];

                $this->gdax->saveData ($coin_name, $currencypair);

            }

        }

    }

    public function getcurrencyPair ()
    {
        return $this->gdax->getAllCurrencyPair();
    }


    public function getMarketHistory ()
    {

        $currencypair = $this->getcurrencyPair();

        $total_buy_trade = 0;

        foreach ($currencypair as $key => $currencypair) {

            $currencypair = $currencypair['currencypair'];
            $result = $this->gdax->getBuy($currencypair);

            $buy = 0;

            foreach ($result as $key => $summary) {

              if ($summary['side'] == "buy") {

                  $buy = $buy + 1;

              }

            }

            $update = $this->gdax->updateBuy ($currencypair , $buy);
            $total_buy_trade = $total_buy_trade + $buy;

        }

        $update_total_buy = $this->gdax->updateTotalBuy ($total_buy_trade);

    }

    public function viewMarket ()
    {

        $data['gdax'] = $this->gdax->getAllByLimit();
        return view ('markets.gdax', $data);

    }

}
