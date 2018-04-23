<?php
    require_once '../function/cryptopia.php';

    $coins = getAll();

    if (isset($_POST['go'])) {

      function redirect($location) {
          header("Location: " . $location);
          exit;
      }

      $market = htmlentities(strip_tags($_POST['market']));

      $market = "../".$market."/market.php";

      redirect($market);

    }


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

  <?php

      include '../form.php';

   ?>

   <div class="container tab-holder">
     <!-- Nav tabs -->
     <ul class="nav nav-tabs" role="tablist">
       <li role="presentation" class="active"><a href="#hibtc" aria-controls="hibtc" role="tab" data-toggle="tab">BTC MARKET</a></li>
       <li role="presentation"><a href="#hibtceth" aria-controls="hibtceth" role="tab" data-toggle="tab">ETH MARKET</a></li>
       <li role="presentation"><a href="#hibtcusdt" aria-controls="hibtcusdt" role="tab" data-toggle="tab">USDT MARKET</a></li>
     </ul>

   </div>

   <!-- Tab panes -->
   <div class="tab-content">
     <div role="tabpanel" class="tab-pane fade in active" id="hibtc">

       <!-- <h5>Sorted by popularity, in descending order</h5> -->
       <div class="container">

         <h2 id="heading"> Cryptopia BTC MARKET Cryptocurrencies Trade Guide</h2>

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
                            <!-- <th>% Change</th> -->

                        </tr>
                    </thead>
                    <tbody>

                       <?php

                           $counter = 1;

                           foreach ($coins as $key => $coin) {

                             $new_value = $coin['current_buy'];
                             $old_value = $coin['buy'];
                             $current_total_trade_volume = $coin['total_buy_trade'];
                             $difference = abs($new_value - $old_value);
                             $current_percentage = (($new_value / $current_total_trade_volume ) * 100);
                             $current_percentage = round( $current_percentage , 2, PHP_ROUND_HALF_EVEN);

                             ?>

                             <tr>
                               <td><?=$counter;?></td>
                               <td><?=$coin['coin'];?></td>
                               <td><?=$coin['currencypair'];?></td>
                               <td><?=$coin['current_buy'];?></td>
                               <td><?=$coin['total_buy_trade'];?></td>
                               <td><?=$coin['buy'];?></td>
                               <td><?=$coin['last_total_buy_trade'];?></td>
                               <!-- <td><?=$current_percentage;?></td> -->


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

     </div>

     <div role="tabpanel" class="tab-pane fade" id="hibtceth">

           <h2 id="heading">HitBTC ETH Market Cryptocurrencies Trade Guide</h2>
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

                               $counter = 1;

                               foreach ($coins_eth as $key => $coin) {

                                 $new_value = $coin['current_buy'];
                                 $old_value = $coin['buy'];
                                 $current_total_trade_volume = $coin['total_buy_trade'];
                                 $difference = abs($new_value - $old_value);
                                 $current_percentage = (($new_value / $current_total_trade_volume ) * 100);
                                 $current_percentage = round( $current_percentage , 2, PHP_ROUND_HALF_EVEN);

                                 ?>

                                 <tr>
                                   <td><?=$counter;?></td>
                                   <td><?=$coin['coin'];?></td>
                                   <td><?=$coin['currencypair'];?></td>
                                   <td><?=$coin['current_buy'];?></td>
                                   <td><?=$coin['total_buy_trade'];?></td>
                                   <td><?=$coin['buy'];?></td>
                                   <td><?=$coin['last_total_buy_trade'];?></td>
                                   <td><?=$current_percentage;?></td>


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
     </div>

     <div role="tabpanel" class="tab-pane fade" id="hibtcusdt">

           <h2 id="heading">HitBTC USDT Market Cryptocurrencies Trade Guide</h2>
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

                               $counter = 1;

                               foreach ($coins_usdt as $key => $coin) {

                                 $new_value = $coin['current_buy'];
                                 $old_value = $coin['buy'];
                                 $current_total_trade_volume = $coin['total_buy_trade'];
                                 $difference = abs($new_value - $old_value);
                                 $current_percentage = (($new_value / $current_total_trade_volume ) * 100);
                                 $current_percentage = round( $current_percentage , 2, PHP_ROUND_HALF_EVEN);

                                 ?>

                                 <tr>
                                   <td><?=$counter;?></td>
                                   <td><?=$coin['coin'];?></td>
                                   <td><?=$coin['currencypair'];?></td>
                                   <td><?=$coin['current_buy'];?></td>
                                   <td><?=$coin['total_buy_trade'];?></td>
                                   <td><?=$coin['buy'];?></td>
                                   <td><?=$coin['last_total_buy_trade'];?></td>
                                   <td><?=$current_percentage;?></td>


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
     </div>

   </div>




</body>

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>



<script type="text/javascript">

$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

$('#myTabs a[href="#hibtc"]').tab('show') // Select tab by name
$('#myTabs a[href="#hibtceth"]').tab('show') // Select tab by name

</script>

</html>
