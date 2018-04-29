<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Repositories\TradesatoshiRepository;

class TradesatoshiController extends Controller
{

  protected $tradesatoshi;

  public function __construct(TradesatoshiRepository $tradesatoshi)
  {
      $this->tradesatoshi = $tradesatoshi;

  }

  public function getCoins ()
  {

      $coins = $this->tradesatoshi->getCoins();

      return $coins;

  }

  public function saveCoins ()
  {

      $coins = $this->getCoins();

      foreach ($coins as $key => $coin) {

          if ($coin['status'] == "OK") {

              $coin_name = $coin['currencyLong'];
              $currencypair = $coin['currency']."_BTC";

              $this->tradesatoshi->saveData ($coin_name, $currencypair);

          }

      }

  }

  public function getcurrencyPair ()
  {
      return $this->tradesatoshi->getAllCurrencyPair();
  }


  public function getMarketHistory ()
  {

      $currencypair = $this->getcurrencyPair();

      $total_buy_trade = 0;

      foreach ($currencypair as $key => $currencypair) {

          $currencypair = $currencypair['currencypair'];
          $market_history = $this->tradesatoshi->getSummary($currencypair);
          $result = $market_history['result'];

          $buy = 0;

          foreach ($result as $key => $summary) {

            if ($summary['orderType'] == "Buy") {

                $buy = $buy + 1;

            }

          }

          $update = $this->tradesatoshi->updateBuy ($currencypair , $buy);
          $total_buy_trade = $total_buy_trade + $buy;

      }

      $update_total_buy = $this->tradesatoshi->updateTotalBuy ($total_buy_trade);

  }

  public function viewMarket ()
  {

      $data['tradesatoshi'] = $this->tradesatoshi->getAllByLimit();
      return view ('markets.tradesatoshi', $data);

  }


}
