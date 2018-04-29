<?php


  if (isset($_POST['go'])) {

    function redirect($location) {
        header("Location: " . $location);
        exit;
    }

    $market = htmlentities(strip_tags($_POST['market']));

    $market = $market."/market.php";

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
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
    <!-- <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/script.js"></script> -->
</head>

<body>
    <!-- <div id="banner">
        <h2 class="banner-h2"> Coin Guide<small>Beta</small></h2>
    </div> -->

    <div class="holder">
        <div class="container">

            <!-- <p class=""> <img class="img img-responsive logo" src="img/logo.png" alt=""></p> -->
            <div class="logo-holder">
                <div class="col-md-4">
                  <p class=""> <img class="img img-responsive market-logo" src="img/logo.png" alt=""></p>

                </div>
                <div class="col-md-offset-2 col-md-6">
                  <ul style="margin-right: 0px;" class="nav navbar-nav pull-right">

                    <li> <a href="/about" class="signup-a">About Us</a> </li>
                    <li> <a href="/privacy" class="signup-a">Privacy Policy</a> </li>
                    <li> <a href="/faqs" class="signup-a">FAQs</a> </li>

                  </ul>
                </div>

            </div>

            <div class="row up-row">

                <div class="home-content">
                  <h1 class="home-h1">COINGUIDE</h1>
                  <!-- <p class="center-block"> <img class="img img-responsive centerimg" src="img/logo2.png" alt=""></p> -->
                  <h3 class="home-h3">Your Cryptocurrency trade guide</h3>
                  <br>
                </div>

            </div>

            <div class="row down-row">

                <div class="col-md-3">

                </div>

                <div class="col-md-6">
                  <form class="form-group" action="/market" method="post">

                    {{ Csrf_field() }}

                    <div class="form-group">
                      <label for="" class="text-center" style="color:#fff">Select an exchange to view market data</label>
                      <select class="form-control" name="market" id="company_size">
                        <option value="option" selected="" disabled="">Select an option</option>
                        <option value="binance">Binance</option>
                        <option value="bittrex">Bittrex</option>
                        <option value="coinexchange">Coinexchange</option>
                        <option value="cryptopia">Cryptopia</option>
                        <option value="hitbtc">HitBTC</option>
                        <option value="kucoin">Kucoin</option>
                        <option value="poloniex">Poloniex</option>
                        <option value="tradesatoshi">TradeSatoshi</option>
                      </select>
                   </div>

                   <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right" name="go">View Market Data</button>
                   </div>

                  </form>
                </div>

                <div class="col-md-3">

                </div>

            </div>

        </div>
    </div>


</body></html>
