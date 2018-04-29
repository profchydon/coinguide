<form class="form-group col-md-offset-8 col-md-4" action="/market" method="post">

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
