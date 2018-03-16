<?php

    include 'include/main.php';

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Cryptocurrencies</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script> -->
</head>

<body>
    <div id="banner">
        <h2 class="banner-h2"> Coin Guide</h2>
    </div>
    <h2 id="heading">Poloniex Cryptocurrencies Trade Guide</h2>
    <!-- <h5>Sorted by popularity, in descending order</h5> -->
    <div class="container">

      <div class="row">

          <div class="col-md-12">
             <h4>Top Gaining Cryptocurrencies</h4>
             <table class="table table-striped table-responsive">
                 <thead>
                     <tr>
                         <th>S/no</th>
                         <th>Coin</th>
                         <th>Currency Pair</th>
                         <th>Buy trade Vol. 5mins ago</th>
                         <th>Total buy trade vol. 5mins ago</th>
                         <th>% of coin in total buy trade vol. 5mins ago</th>
                         <th>Current Buy trade Vol.</th>
                         <th>Current Total buy trade volume</th>
                         <th>% of coin in total buy trade volume</th>

                     </tr>
                 </thead>
                 <tbody>

                   <?php

                   // Lets fetch record from database
                   $records = fetchRecords();

                   //  Get Previous Top coin
                   $prev_top_coin_details = GetPrevTopCoin();

                   $prev_top_coin = $prev_top_coin_details[0]['coin'];

                   $prev_top_coin_currency = $prev_top_coin_details[0]['currencypair'];

                   $prev_top_coin_buy_trade = $prev_top_coin_details[0]['buy'];

                   $prev_top_coin_current_buy_trade = GetPrevTopCoinNewBuyTrade($prev_top_coin_currency);

                   $prev_top_coin_current_buy_trade = $prev_top_coin_current_buy_trade[0]['current_buy'];

                   //  echo "<pre>";
                    //
                   //  var_dump($records);

                    $total_trade_volume_resources = selectTotalCurrentBuy();

                    $previous_total_trade_volume = 0;

                    $current_total_trade_volume = 0;

                    $percentage_array = array();

                    foreach ($total_trade_volume_resources as $key => $total_trade_volume_resource) {

                         $previous_total_trade_volume += $total_trade_volume_resource['buy'];

                         $current_total_trade_volume += $total_trade_volume_resource['current_buy'];
                    }

                    // Initialize counter
                    $counter = 1;

                    // Loop through records
                    foreach ($records as $key => $record) {

                           $new_value = $record['current_buy'];
                           $old_value = $record['buy'];

                           $difference = abs($new_value - $old_value);

                           $previous_percentage = (($old_value / $previous_total_trade_volume ) * 100);

                           $previous_percentage  = round( $previous_percentage , 2, PHP_ROUND_HALF_EVEN);

                           $current_percentage = (($new_value / $current_total_trade_volume ) * 100);

                           $current_percentage = round( $current_percentage , 2, PHP_ROUND_HALF_EVEN);

                           $difference_in_trade = abs($current_total_trade_volume - $previous_total_trade_volume);

                           $percentage_change = ((($new_value - $old_value) / $difference_in_trade) * 100);

                           $percentage_change  = round( $percentage_change , 2, PHP_ROUND_HALF_EVEN);

                           $percentage_array[$record['coin']] = $percentage_change;

                           //$update = updatePercentageChange ($percentage_change, $record['currencypair']);

                 ?>
                            <tr>
                              <td><?=$counter;?></td>
                              <td><?=$record['coin'];?></td>
                              <td>BTC_<?=$record['currencypair'];?></td>
                              <td><?=$record['buy'];?></td>
                              <td><?=$previous_total_trade_volume ;?></td>
                              <td><?=$previous_percentage?>%</td>
                              <td><?=$record['current_buy'];?></td>
                              <td><?=$current_total_trade_volume ;?></td>
                              <td><?=$current_percentage?>%</td>

                            </tr>

                    <?php
                            $counter++;
                            }

                            arsort($percentage_array);

                            // Get the top coin as the most popular coin
                            $most_popular_coin = array_keys($percentage_array)[0];
                            $most_popular_coin_value = array_values($percentage_array)[0];

                            $current_top_coin_details = GetCurrentTopCoinDetails($most_popular_coin);

                            $word = $prev_top_coin_current_buy_trade < $prev_top_coin_buy_trade ? "an increase" : "a decrease";

                     ?>


               </tbody>
               </table>

          </div>


          <div class="col-md-12">
              <div class="alert alert-success" role="alert">
                  <h4>Who is gaining the shift?</h4>



                  </p>
              </div>
          </div>

      </div>



    </div>

</body></html>
