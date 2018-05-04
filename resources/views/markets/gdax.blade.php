
@extends('layout.master')

@section('content')

<div class="container home-container">

  <div class="row home-row">

      @include('layout.form')

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

         <h2 id="heading"> GDAX BTC MARKET Cryptocurrencies Trade Guide</h2>

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

                        </tr>
                    </thead>
                    <tbody>

                      @php
                          $counter = 1;
                      @endphp

                      @foreach ( $gdax as $coin )

                          @php

                              $new_value = $coin['current_buy'];
                              $old_value = $coin['buy'];
                              $current_total_trade_volume = $coin['total_buy_trade'];
                              $difference = abs($new_value - $old_value);
                              $current_percentage = (($new_value / $current_total_trade_volume ) * 100);
                              $current_percentage = round( $current_percentage , 2, PHP_ROUND_HALF_EVEN);

                          @endphp

                          <tr>

                            <td> {{ $counter }} </td>
                            <td> {{ $coin['coin'] }} </td>
                            <td> {{ $coin['currencypair'] }} </td>
                            <td> {{ $coin['current_buy'] }} </td>
                            <td> {{ $coin['total_buy_trade'] }} </td>
                            <td> {{ $coin['buy'] }} </td>
                            <td> {{ $coin['last_total_buy_trade'] }}</td>

                          </tr>

                      @endforeach

                  </tbody>
                  </table>

             </div>

         </div>

       </div>

     </div>

     <div role="tabpanel" class="tab-pane fade" id="hibtceth">

           <h2 id="heading">GDAX ETH Market Cryptocurrencies Trade Guide</h2>
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



                      </tbody>
                      </table>

                 </div>




             </div>



           </div>
     </div>

     <div role="tabpanel" class="tab-pane fade" id="hibtcusdt">

           <h2 id="heading">GDAX USDT Market Cryptocurrencies Trade Guide</h2>
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



                      </tbody>
                      </table>

                 </div>




             </div>



           </div>
     </div>

   </div>

@endsection
