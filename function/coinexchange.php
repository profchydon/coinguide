<?php

function save ($coin, $currencypair, $market_id, $date_saved) {
  require '../database/database.php';
  $query = $pdo->prepare('INSERT into coinexchange (coin, currencypair, market_id, date_saved) values (:coin , :currencypair, :market_id, :date_saved) ');
  $query->bindParam(':coin' , $coin);
  $query->bindParam(':currencypair' , $currencypair);
  $query->bindParam(':market_id' , $market_id);
  $query->bindParam(':date_saved' , $date_saved);
  if ($query->execute()) {
    return true;
  }else {
    return false;
  }
}

function updatebuy ($buy, $change, $market_id)
{
    require '../database/database.php';
    $query = $pdo->prepare("UPDATE `coins`.`coinexchange` SET `buy`= :buy, `change`= :change WHERE  `market_id`= :market_id");
    $query->bindParam(':buy' , $buy);
    $query->bindParam(':change' , $change);
    $query->bindParam(':market_id' , $market_id);
    if ($query->execute()) {
        return true;
    }else {
      return false;
    }
}

function selectMarketID()
{

  require '../database/database.php';
  $query = $pdo->prepare('SELECT market_id FROM coinexchange');
  if ($query->execute()) {
    $records = $query->fetchAll(PDO::FETCH_ASSOC);
    return $records;
  }

}

  function all ()
  {

    require '../database/database.php';
    $query = $pdo->prepare('SELECT * FROM coinexchange ORDER BY buy DESC LIMIT 20');
    if ($query->execute()) {
      $records = $query->fetchAll(PDO::FETCH_ASSOC);
      return $records;
    }

  }

  function allEmptyBuys ()
  {

    require '../database/database.php';
    $query = $pdo->prepare('SELECT * FROM coinexchange WHERE buy IS NULL');
    if ($query->execute()) {
      $records = $query->fetchAll(PDO::FETCH_ASSOC);
      return $records;
    }

  }


 ?>
