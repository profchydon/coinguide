<?php

require_once '../function/hitbtc.php';

// $coins = getCoins();

// foreach ($coins as $key => $coin) {
//
//     if ($coin['delisted'] == false) {
//
//       $coin_name = $coin['fullName'];
//       $symbol = $coin['id'];
//
//       $save_data = saveEthData ($coin_name , $symbol);
//
//     }
//
// }
//
// $summary = getSummary();
//
// foreach ($summary as $key => $coins) {
//
//   if ($coins['quoteCurrency'] == "ETH") {
//
//       $symbol = $coins['baseCurrency'];
//       $currencypair = $coins['id'];
//
//       $update_data = updateEthTable ($symbol, $currencypair);
//
//   }
//
// }

$all = getAllEthMarket();

$total_buy_trade = 0;

foreach ($all as $key => $pair) {

    $currencypair = $pair['currencypair'];



    if (!empty($currencypair)) {

      $trades = getBuy ($currencypair);

      $buy = 0;

      foreach ($trades as $key => $trade) {

          if ($trade['side'] == "buy") {

              $buy = $buy + 1;

          }

      }

      $update = updateEthBuy ($buy, $currencypair);
      $total_buy_trade = $total_buy_trade + $buy;

    }

}

updateTotalBuyEthMarket ($total_buy_trade);

foreach ($all as $key => $value) {

    $total_buy_trade = $total_buy_trade + $value['current_buy'];

}

updateTotalBuyEthMarket ($total_buy_trade);

 ?>
