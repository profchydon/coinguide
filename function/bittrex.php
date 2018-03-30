<?php

function getCoins ()
{

    $coins = file_get_contents('https://bittrex.com/api/v1.1/public/getmarkets');

    // Convert JSOn resource to object
    $coins = json_decode($coins);

    // Convert object to array
    $coins = json_decode(json_encode($coins) , TRUE);

    return $coins;

}

function saveData($coin, $currencypair)
{
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

?>
