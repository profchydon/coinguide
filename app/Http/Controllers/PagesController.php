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

    public function about ()
    {
      return view ('about');
    }

    public function privacy ()
    {
      return view ('privacy');
    }

    public function faqs ()
    {
      return view ('faqs');
    }
}
