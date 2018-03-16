<?php

    function getAllCoins ()
    {
      /**
          **  Call the poloniex API to get all coins available
          **
          **/
          $coins = file_get_contents('https://poloniex.com/public?command=returnCurrencies');

          // Convert JSOn resource to object
          $coins = json_decode($coins);

          // Convert object to array
          $coins = json_decode(json_encode($coins) , TRUE);

          return $coins;
    }


    // This function fetches the static record in the database
    function fetchRecords () {
        require 'database/database.php';
        $query = $pdo->prepare('SELECT * FROM previous ORDER BY current_buy DESC LIMIT 10');
        // $query = $pdo->prepare('SELECT * FROM previous ORDER BY buy DESC');
        if ($query->execute()) {
          $records = $query->fetchAll(PDO::FETCH_ASSOC);
          return $records;
        }
    }

    function GetPrevTopCoin()
    {

      require 'database/database.php';
      $query = $pdo->prepare('SELECT buy, coin, currencypair FROM previous ORDER BY buy DESC LIMIT 1');
      if ($query->execute()) {
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        return $records;
      }

    }

    function GetPrevTopCoinNewBuyTrade($currencypair)
    {

      require 'database/database.php';
      $query = $pdo->prepare('SELECT current_buy FROM previous WHERE currencypair = :currencypair');
      $query->bindParam(':currencypair' ,$currencypair);
      if ($query->execute()) {
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        return $records;
      }

    }

    function selectTotalCurrentBuy()
    {

      require 'database/database.php';
      $query = $pdo->prepare('SELECT current_buy, buy FROM previous');
      if ($query->execute()) {
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        return $records;
      }

    }

    function GetCurrentTopCoinDetails($coin)
    {

      require 'database/database.php';
      $query = $pdo->prepare('SELECT buy, coin, currencypair, current_buy FROM previous WHERE coin = :coin');
      $query->bindParam(':coin' , $coin);
      if ($query->execute()) {
        $records = $query->fetchAll(PDO::FETCH_ASSOC);
        return $records;
      }

    }

 ?>
