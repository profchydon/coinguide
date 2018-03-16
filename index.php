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
                    $counter = 1;

                    // Loop through coins array to get details for each coin
                    foreach ($coins as $key => $coin) {

                      $coin_delisted = $coin['delisted'];

                      $coin_disabled = $coin['disabled'];

                      // drop delisted coins
                      if ((!$coin_delisted)) {

                         // drop disabled coins
                         if ((!$coin_disabled)) {



                            // Get the coin abbreviation example Bitcoin (BTC), Ethereum (ETH)
                            $currency = $key;

                            // Form a currency pair with the abbreviation example BTC_ETH
                            $currencypair = "BTC_".$key;

                            //Get coin name
                            $coin_name = $coin['name']; ?>

                            <tr>
                               <td><?=$counter;?></td>
                               <td><?=$coin_name;?></td>
                               <td><?= $currencypair; ?></td>

                            </tr>
                    <?php
                      $counter++;
                      }
                    }

                  }

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
