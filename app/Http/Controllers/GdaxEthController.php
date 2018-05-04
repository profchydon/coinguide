<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\GdaxEthRepository;

class GdaxEthController extends Controller
{
    //
    protected $gdaxeth;

    public function __construct(GdaxEthRepository $gdaxeth)
    {
        $this->gdaxeth = $gdaxeth;

    }

    public function getCoins ()
    {

        $coins = $this->gdaxeth->getCoins();

        return $coins;

    }

    public function saveCoins ()
    {

        $coins = $this->getCoins();

        foreach ($coins as $key => $coin) {

            if ($coin['quote_currency'] == "ETH") {

                $coin_name = $coin['base_currency'];
                $currencypair = $coin['id'];

                $this->gdaxeth->saveData ($coin_name, $currencypair);

            }

        }

    }

    public function getcurrencyPair ()
    {
        return $this->gdaxeth->getAllCurrencyPair();
    }


    public function getMarketHistory ()
    {

        $currencypair = $this->getcurrencyPair();

        $total_buy_trade = 0;

        foreach ($currencypair as $key => $currencypair) {

            $currencypair = $currencypair['currencypair'];
            $result = $this->gdaxeth->getBuy($currencypair);

            $buy = 0;

            foreach ($result as $key => $summary) {

              if ($summary['side'] == "buy") {

                  $buy = $buy + 1;

              }

            }

            $update = $this->gdaxeth->updateBuy ($currencypair , $buy);
            $total_buy_trade = $total_buy_trade + $buy;

        }

        $update_total_buy = $this->gdaxeth->updateTotalBuy ($total_buy_trade);

    }

    public function viewMarket ()
    {

        $data['gdaxeth'] = $this->gdaxeth->getAllByLimit();
        return view ('markets.gdaxeth', $data);

    }

}
