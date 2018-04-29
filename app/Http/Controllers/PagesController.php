<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function welcome ()
    {
      return view ('welcome');
    }

    public function market ()
    {

        if (isset($_POST['go'])) {

            $market = htmlentities(strip_tags($_POST['market']));

            return redirect('/'.$market);

        }

    }
}
