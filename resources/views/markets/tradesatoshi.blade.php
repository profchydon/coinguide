
@extends('layout.master')

@section('content')

<div class="container home-container">

  <div class="row home-row">

      @include('layout.form')

    <h2 id="heading">TradeSatoshi Cryptocurrencies Trade Guide</h2>
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

                       foreach ($tradesatoshi as $key => $coin) {

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

@endsection
