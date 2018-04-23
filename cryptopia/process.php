<?php

require_once '../function/cryptopia.php';

$coins = getCoins();

$coins = $coins['Data'];

foreach ($coins as $key => $coin) {

    if ($coin['Status'] == "OK" && $coin['BaseSymbol'] == "BTC") {

      $coin_name = $coin['Currency'];
      $symbol = $coin['Symbol'];
      $currencypair = $coin['Label'];

      saveData ($coin_name, $symbol, $currencypair);

    }

}

$all = getAll();

$total_buy_trade = 0;

foreach ($all as $key => $pair) {

    $currencypair = $pair['symbol']."_BTC";

    if (!empty($currencypair)) {

      $trades = getBuy ($currencypair);

      $trades = $trades['Data'];

      $buy = 0;

      foreach ($trades as $key => $trade) {

          if ($trade['Type'] == "Buy") {

              $buy = $buy + 1;

          }

      }

      $update = updateBuy ($buy, $pair['symbol']);
      $total_buy_trade = $total_buy_trade + $buy;

    }

}

updateTotalBuy ($total_buy_trade);

foreach ($all as $key => $value) {

    $total_buy_trade = $total_buy_trade + $value['buy'];

}
//
updateTotalBuy ($total_buy_trade);

?>
