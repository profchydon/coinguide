<?php

    $m = file_get_contents("https://www.coinexchange.io/api/v1/getmarkets");

    $m = json_decode($m , true);

    echo "<pre>";
    var_dump($m);

 ?>
