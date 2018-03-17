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

    function selectPastTime()
    {
      require 'database/database.php';
      $query = $pdo->prepare('SELECT date_saved FROM current');
      if ($query->execute()) {
        $time = $query->fetchAll(PDO::FETCH_ASSOC);
        return $time;
      }
    }


    // This function fetches the static record in the database
    function fetchRecord () {
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

    function deleteCurrentRecords () {

      require 'database/database.php';
      $query = $pdo->prepare('DELETE FROM current');
      if ($query->execute()) {
          return true;
      }else {
        return false;
      }

    }

    function updateCurrentBuyInPreviousTable ($buy, $total_trade_volume, $currencypair)
    {
        require 'database/database.php';
        $query = $pdo->prepare('UPDATE previous SET current_buy = :buy, total_trade_volume = :total_trade_volume WHERE currencypair = :currencypair');
        $query->bindParam(':buy' , $buy);
        $query->bindParam(':total_trade_volume' , $total_trade_volume);
        $query->bindParam(':currencypair' , $currencypair);
        if ($query->execute()) {
            return true;
        }else {
          return false;
        }
    }

    // This function inserts data into the current table after processing poloniex API
        function updateCurrentTable ($coin, $currencypair, $buy, $sell, $date_saved ) {
        require 'database/database.php';
        $query = $pdo->prepare('INSERT into current (coin , currencypair, buy, sell, date_saved) values (:coin , :currencypair, :buy, :sell, :date_saved) ');
        $query->bindParam(':coin' , $coin);
        $query->bindParam(':currencypair' , $currencypair);
        $query->bindParam(':buy' , $buy);
        $query->bindParam(':sell' , $sell);
        $query->bindParam(':date_saved' , $date_saved);
        if ($query->execute()) {
          return true;
        }else {
          return false;
        }
    }

    // This function inserts data into the current table after processing poloniex API
        function updatePreviousTable ($coin, $currencypair, $buy, $sell, $date_saved ) {
          require 'database/database.php';
          $query = $pdo->prepare('INSERT into previous (coin , currencypair, buy, sell, date_saved) values (:coin , :currencypair, :buy, :sell, :date_saved) ');
          $query->bindParam(':coin' , $coin);
          $query->bindParam(':currencypair' , $currencypair);
          $query->bindParam(':buy' , $buy);
          $query->bindParam(':sell' , $sell);
          $query->bindParam(':date_saved' , $date_saved);
          if ($query->execute()) {
            return true;
          }else {
            return false;
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

    function ResetTableID ()
    {
      require 'database/database.php';
      $query = $pdo->prepare('ALTER previous auto_increment = 1;');
      if ($query->execute()) {
          return true;
      }else {
        return false;
      }

    }

    function fetchRecordsFromCurrent () {
        require 'database/database.php';
        $query = $pdo->prepare('SELECT * FROM current ORDER BY buy DESC');
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

    function deletePreviousRecords () {

      require 'database/database.php';
      $query = $pdo->prepare('DELETE FROM previous');
      if ($query->execute()) {
          return true;
      }else {
        return false;
      }

    }

 ?>
