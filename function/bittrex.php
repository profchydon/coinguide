<?php

function getCoins () {

    $coins = file_get_contents('https://bittrex.com/api/v1.1/public/getmarkets');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

}

function saveData($coin, $currencypair) {

    require '../database/database.php';
    $query = $pdo->prepare('INSERT into bittrex (coin , currencypair) values (:coin , :currencypair) ');
    $query->bindParam(':coin' , $coin);
    $query->bindParam(':currencypair' , $currencypair);

    if ($query->execute()) {

      return true;

    }else {

      return false;

    }

}

function getAll ()
{

  require '../database/database.php';
  $query = $pdo->prepare('SELECT * FROM bittrex ORDER BY current_buy DESC LIMIT 200');

  if ($query->execute()) {

    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

}

function getTotalBuyVolume ()
{

  require '../database/database.php';
  $query = $pdo->prepare('SELECT buy , current_buy FROM bittrex');

  if ($query->execute()) {

    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

}


function getMarketSummary ($currencypair)
{

    $market_summary = file_get_contents('https://bittrex.com/api/v1.1/public/getmarketsummary?market='.$currencypair);

    return $market_summary;

}

function updateBittrexTable ($buy, $trade_volume, $currencypair)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE bittrex SET current_buy = :buy, trade_volume = :trade_volume WHERE currencypair = :currencypair');
    $query->bindParam(':buy' , $buy);
    $query->bindParam(':trade_volume' , $trade_volume);
    $query->bindParam(':currencypair' , $currencypair);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

?>
