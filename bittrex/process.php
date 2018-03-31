<?php

require_once '../function/bittrex.php';

$all_coins = getAll();

// if (empty($all_coins)) {
//
//   $coins = file_get_contents('https://bittrex.com/api/v1.1/public/getmarkets');
//
//   // Convert JSOn resource to object
//   $coins = json_decode($coins);
//
//   // Convert object to array
//   $coins = json_decode(json_encode($coins) , TRUE);
//
//   $coins = $coins['result'];
//
//   foreach ($coins as $key => $coin) {
//
//        $coin_inactive = $coin['IsActive'];
//
//        if ($coin_inactive && $coin["BaseCurrency"] == "BTC") {
//
//        $coin_name = $coin['MarketCurrencyLong'];
//        $currencypair = $coin['MarketName'];
//
//        $save_data = saveData($coin_name , $currencypair);
//
//       }
//
//   }
//
// }

foreach ($all_coins as $key => $coins) {

    $currencypair = $coins['currencypair'];

    $market_summary = getMarketSummary ($currencypair);

    // Convert JSOn resource to object
    $coins_summary = json_decode($market_summary);

    // Convert object to array
    $coins_summary = json_decode(json_encode($coins_summary) , TRUE);

    $coins = $coins_summary['result'];

    $buy = $coins[0]['OpenBuyOrders'];
    $trade_volume = $coins[0]['Volume'];

    $update_bittrex_table = updateBittrexTable ($buy, $trade_volume, $currencypair);

    // echo "<pre>";
    // var_dump($coins);

}

// echo "<pre>";
// var_dump($market_summary);



?>
