<?php

function getCoins () {

    $coins = file_get_contents('https://tradesatoshi.com/api/public/getcurrencies');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins['result'];

}

function getSummary ($currencypair) {

    $coins = file_get_contents('https://tradesatoshi.com/api/public/getmarkethistory?market='.$currencypair.'&count=200');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

}


function saveData ($coin, $currencypair) {

    require '../database/database.php';
    $query = $pdo->prepare('INSERT into tradesatoshi (coin, currencypair) values (:coin, :currencypair)  ');
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
    $query = $pdo->prepare('SELECT * FROM tradesatoshi ORDER BY buy DESC');

    if ($query->execute()) {
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
    }

      return $data;

}

function getAllByLimit ()
{
    require '../database/database.php';
    $query = $pdo->prepare('SELECT * FROM tradesatoshi ORDER BY buy DESC LIMIT 40');

    if ($query->execute()) {
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
    }

      return $data;

}


function updateBuy ($buy, $currencypair)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE tradesatoshi SET current_buy = :buy WHERE currencypair = :currencypair');
    $query->bindParam(':currencypair' , $currencypair);
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
    $query = $pdo->prepare('UPDATE tradesatoshi SET total_buy_trade = :total_buy_trade');
    $query->bindParam(':total_buy_trade' , $total_buy_trade);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

?>
