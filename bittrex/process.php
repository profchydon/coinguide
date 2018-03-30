<?php

require_once '../function/bittrex.php';

$coins = file_get_contents('https://bittrex.com/api/v1.1/public/getmarkets');

// Convert JSOn resource to object
$coins = json_decode($coins);

// Convert object to array
$coins = json_decode(json_encode($coins) , TRUE);

$coins = $coins['result'];


foreach ($coins as $key => $coin) {

     $coin_inactive = $coin['IsActive'];

     if ($coin_inactive && $coin["BaseCurrency"] == "BTC") {

     $coin_name = $coin['MarketCurrencyLong'];
     $currencypair = $coin['MarketName'];

     $save_data = saveData($coin_name , $currencypair);

    }

}




?>
