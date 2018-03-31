<?php
    include '../function/bittrex.php';

    $current = getTotalBuyVolume ();

    $total_buy_volume = 0;

    $total_buy_volume_5mins_ago = 0;

    foreach ($current as $key => $buy) {

      $total_buy_volume = $total_buy_volume + $buy['current_buy'];

      $total_buy_volume_5mins_ago = $total_buy_volume_5mins_ago + $buy['buy'];

    }

    if (isset($_POST['go'])) {

      function redirect($location) {
          header("Location: " . $location);
          exit;
      }

      $market = htmlentities(strip_tags($_POST['market']));

      $market = "../".$market."/market.php";

      redirect($market);

    }

    $records = getAll();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Popular Cryptocurrencies</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <!-- <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script> -->
</head>

<body>
  <div id="banner">
      <p class=""> <img class="img img-responsive market-logo" src="../img/logo.png" alt=""></p>
  </div>

  <div class="row">
      <form class="" action="" method="post">

          <div class="col-md-offset-7 col-md-3">
            <div class="form-group">

              <select class="form-control" name="market" id="select">
                <option value="option" selected="" disabled="">Select an exchange to view market data</option>
                <option value="poloniex">Poloniex</option>
                <option value="coinexchange">Coinexchange</option>
                <option value="bittrex">Bittrex</option>
                <option value="kucoin">Kucoin</option>
                <option value="binance">Binance</option>
              </select>
           </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
                 <button type="submit" id="btn" class="btn btn-primary" name="go">View Market Data</button>
            </div>
          </div>

      </form>
  </div>

    <h2 id="heading">Bittrex Cryptocurrencies Trade Guide</h2>
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
                         <th>Buy trade Vol.</th>
                         <th>Total buy trade vol.</th>
                         <th>Buy trade Vol. 5mins ago</th>
                         <th>Total buy trade vol. 5 mins ago</th>
                         <th>% Change</th>

                     </tr>
                 </thead>
                 <tbody>

                   <?php

                    // Initialize counter
                    $counter = 1;

                    // Loop through records
                    foreach ($records as $key => $record) {

                      $base_buy = $record['current_buy'] - $record['buy'];
                      $base_buy_trade_volume = $total_buy_volume_5mins_ago - $total_buy_volume;

                      $change = ($base_buy / $base_buy_trade_volume);

                      $change = round( $change , 2, PHP_ROUND_HALF_EVEN);

                 ?>
                            <tr>
                              <td><?=$counter;?></td>
                              <td><?=$record['coin'];?></td>
                              <td><?=$record['currencypair'];?></td>
                              <td><?=$record['buy'];?></td>
                              <td><?=$total_buy_volume_5mins_ago?></td>
                              <td><?=$record['current_buy'];?></td>
                              <td><?=$total_buy_volume;?></td>
                              <td><?=$change;?></td>

                            </tr>

                    <?php
                            $counter++;
                            }

                     ?>

               </tbody>
               </table>

          </div>




      </div>



    </div>

</body></html>
