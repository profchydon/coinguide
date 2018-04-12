<?php

include '../function/tradesatoshi.php';

$coins = getCoins();
$all = getAll();

foreach ($coins as $key => $coin) {

    if ($coin['status'] == "OK") {

        $coin_name = $coin['currencyLong'];
        $currencypair = $coin['currency']."_BTC";

        saveData ($coin_name, $currencypair);

    }

}

$total_buy_trade = 0;

foreach ($all as $key => $all) {

    $currencypair = $all['currencypair'];
    $summary = getSummary($currencypair);
    $result = $summary['result'];

    $buy = 0;

    foreach ($result as $key => $summary) {

      if ($summary['orderType'] == "Buy") {

          $buy = $buy + 1;

      }

    }

    $update = updateBuy ($buy, $currencypair);
    $total_buy_trade = $total_buy_trade + $buy;

}

updateTotalBuy ($total_buy_trade);

 ?>
