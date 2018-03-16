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


 ?>
