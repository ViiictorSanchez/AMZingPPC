<?php
// namespace AmazonAdvertisingApi;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Versions extends Controller
{


    public function __construct()
    {
     
         // parent::__construct();    

    }
  
    public $versionStrings = array(
        "apiVersion"         => "v1",
        "applicationVersion" => "1.2"
    );
}
