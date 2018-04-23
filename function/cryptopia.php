<?php

function getCoins () {

    $coins = file_get_contents('https://www.cryptopia.co.nz/api/GetTradePairs');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

}

function getBuy ($currencypair) {

    $buy = file_get_contents('https://www.cryptopia.co.nz/api/GetMarketHistory/'.$currencypair.'/100');

    // Convert JSOn resource to object
    $buy = json_decode($buy);

    // Convert object to array
    $buy = json_decode(json_encode($buy) , TRUE);

    return $buy;

}

function saveData ($coin, $symbol, $currencypair) {

    require '../database/database.php';
    $query = $pdo->prepare('INSERT into cryptopia (coin, symbol, currencypair) values (:coin, :symbol, :currencypair) ');
    $query->bindParam(':coin' , $coin);
    $query->bindParam(':symbol' , $symbol);
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
    $query = $pdo->prepare('SELECT * FROM cryptopia ORDER BY buy DESC LIMIT 30');

    if ($query->execute()) {
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
    }

      return $data;

}

function updateBuy ($buy, $symbol)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE cryptopia SET current_buy = :buy WHERE symbol = :symbol');
    $query->bindParam(':symbol' , $symbol);
    $query->bindParam(':buy' , $buy);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function updateTotalBuy ($total_buy_trade)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE cryptopia SET total_buy_trade = :total_buy_trade');
    $query->bindParam(':total_buy_trade' , $total_buy_trade);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}
