<?php

include '../function/coinexchange.php';

$check = selectMarketID();

if (empty($check)) {

  $records = file_get_contents('https://www.coinexchange.io/api/v1/getmarkets');

  $records = json_decode($records , true);

  $records = $records['result'];

  $date_saved = time();

  foreach ($records as $key => $record) {

      $market_id = $record['MarketID'];
      $coin = $record['MarketAssetName'];
      $currencypair = $record['MarketAssetCode'];

      // We can now save records to database
      $save = save ($coin, $currencypair, $market_id, $date_saved);

  }

}

$count = 1;
$all = allEmptyBuys ();
$n = count($all);

for ($i=0; $i < $n; $i++) {

      if (empty($all[$i]['buy'])) {
        $market_id = $all[$i]['market_id'];
        $url = 'https://www.coinexchange.io/api/v1/getmarketsummary?market_id='.$market_id;
        $market_summary = file_get_contents($url);
        $market_summary = json_decode($market_summary , true);

        $market_summary = $market_summary['result'];
        $buy = $market_summary['BuyOrderCount'];
        $market_id = $market_id;
        $change = $market_summary['Change'];
        $update = updatebuy ($buy, $change, $market_id);

        if ($update) {
          echo "yes";
        }else {
          echo "string";
        }
        // var_dump($market_summary);
        // die();
      }else {

      }

}



// foreach ($all as $key => $value) {
//
//     if ($all['buy'] == "") {
//         echo $all['coin'] ." has no buy";
//         echo "<br>";
//     }else {
//         echo $all['coin'] ." has buy";
//         echo "<br>";
//     }
//
// }
// echo "<pre>";
// var_dump($all);
// foreach ($all as $key => $value) {
// echo $all['coin'];
// }
die();

foreach ($check as $key => $market_id) {
    $market_id = $market_id['market_id'];
    $url = 'https://www.coinexchange.io/api/v1/getmarketsummary?market_id='.$market_id;
    $market_summary = file_get_contents($url);
    $market_summary = json_decode($market_summary , true);
    $market_summary = $market_summary['result'];
    $buy = $market_summary['BuyOrderCount'];
    $market_id = $market_id;
    $change = $market_summary['Change'];
    $update = updatebuy ($buy, $change, $market_id);

        if ($update) {
          echo "yes";
        }else {
          echo "string";
        }

}

  // foreach ($records as $key => $summary) {
  //
  //     $currencypair = $summary['MarketAssetCode'];
  //     $market_id = $summary['MarketID'];
  //     $url = 'https://www.coinexchange.io/api/v1/getmarketsummary?market_id='.$market_id;
  //     $market_summary = file_get_contents($url);
  //     $market_summary = json_decode($market_summary , true);
  //     $market_summary = $market_summary['result'];
  //     $buy = $market_summary['BuyOrderCount'];
  //     $change = $market_summary['Change'];
  //
  //     $update = updatebuy ($buy, $change, $currencypair, $market_id);
  //
  //     if ($update) {
  //       echo "yes";
  //     }else {
  //       echo "string";
  //     }
  // }




?>
