<?php

function getCoins () {

    $coins = file_get_contents('https://api.hitbtc.com/api/2/public/currency');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

}

function getSummary () {

    $coins = file_get_contents('https://api.hitbtc.com/api/2/public/symbol');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

}

function getBuy ($currencypair) {

    $buy = file_get_contents('https://api.hitbtc.com/api/2/public/trades/'.$currencypair);

    // Convert JSOn resource to object
    $buy = json_decode($buy);

    // Convert object to array
    $buy = json_decode(json_encode($buy) , TRUE);

    return $buy;

}

function updateBuy ($buy, $currencypair)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE hibtc SET current_buy = :buy WHERE currencypair = :currencypair');
    $query->bindParam(':currencypair' , $currencypair);
    $query->bindParam(':buy' , $buy);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function updateEthBuy ($buy, $currencypair)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE hibtceth SET current_buy = :buy WHERE currencypair = :currencypair');
    $query->bindParam(':currencypair' , $currencypair);
    $query->bindParam(':buy' , $buy);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}


function saveData ($coin, $symbol) {

    require '../database/database.php';
    $query = $pdo->prepare('INSERT into hibtc (coin, symbol) values (:coin, :symbol)  ');
    $query->bindParam(':coin' , $coin);
    $query->bindParam(':symbol' , $symbol);

    if ($query->execute()) {

      return true;

    }else {

      return false;

    }

}

function saveEthData ($coin, $symbol) {

    require '../database/database.php';
    $query = $pdo->prepare('INSERT into hibtceth (coin, symbol) values (:coin, :symbol)  ');
    $query->bindParam(':coin' , $coin);
    $query->bindParam(':symbol' , $symbol);

    if ($query->execute()) {

      return true;

    }else {

      return false;

    }

}

function updateTable ($symbol, $currencypair)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE hibtc SET currencypair = :currencypair WHERE symbol = :symbol');
    $query->bindParam(':currencypair' , $currencypair);
    $query->bindParam(':symbol' , $symbol);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function updateEthTable ($symbol, $currencypair)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE hibtceth SET currencypair = :currencypair WHERE symbol = :symbol');
    $query->bindParam(':currencypair' , $currencypair);
    $query->bindParam(':symbol' , $symbol);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function saveEth ($coin, $symbol)
{
    require '../database/database.php';
    $query = $pdo->prepare('INSERT into hibtceth (coin, symbol) values (:coin, :symbol) ');
    $query->bindParam(':coin' , $coin);
    $query->bindParam(':symbol' , $symbol);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function updateTotalBuy ($total_buy_trade)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE hibtc SET total_buy_trade = :total_buy_trade');
    $query->bindParam(':total_buy_trade' , $total_buy_trade);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function updateTotalBuyEthMarket ($total_buy_trade)
{
    require '../database/database.php';
    $query = $pdo->prepare('UPDATE hibtceth SET total_buy_trade = :total_buy_trade');
    $query->bindParam(':total_buy_trade' , $total_buy_trade);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function getAll ()
{
    require '../database/database.php';
    $query = $pdo->prepare('SELECT * FROM hibtc ORDER BY buy DESC LIMIT 30');

    if ($query->execute()) {
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
    }

      return $data;

}

function getAllEthMarket ()
{
    require '../database/database.php';
    $query = $pdo->prepare('SELECT * FROM hibtceth ORDER BY buy DESC LIMIT 30');

    if ($query->execute()) {
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
    }

      return $data;

}


 ?>
