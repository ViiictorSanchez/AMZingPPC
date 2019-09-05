<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;




class TestController extends Client
{
 protected $tokenAcceso;


 protected $tokenRefrescar;

 protected $a;


 protected $b;

   // protected $config = array(); 




 public function __construct()
 {


      // parent::__construct($this->getConfig($a = null , $b = null));

    // parent::__construct($this->getConfig());

    // parent::__construct($this->getConfig());   

    // print_r($this->getConfig());

         // print_r($this->getConfig($a = null , $b = null));           

}


public function getConfig()
{  

  // $this->client = new \AmazonAdvertisingApi\Client($this->config); 

    // $this->test();

    // print_r($this->a);

    // print_r($this->test2("12","34"));

    // print_r($this->a);

    // $this->test2($z = null,$v = null);

    //estoy usando el config de la clase padre
     $this->config = array(
        "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
        "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
        "region" => "na",
        "accessToken" => $this->tokenAcceso,
        "refreshToken" => $this->tokenRefrescar,
        "sandbox" => true,
        "prod" => false);


    //    $test = new Client($this->config);

    // echo "<br>";
    // print_r($test);


    // print_r($client); 



}




public function test()
{

    $this->tokenAcceso = "Atza|IwEBIN-RhhmxFcgD5AqD5U5JcJnD5cZNsZzMZyGB1e5lpiM6Y9FakTAYckUYm2g5jdQBw_XClyE81-8dNRbPt9BvjiCrBUXXdXory6G9yHseKTd7eHVaL1NasFWWmPz1g9BR7QMJSHtP34Aq_NiJeVrZ9-FJaS8aIsjEf7xzces2Ahi29oDvLV7MvcIpsS62qgjoNizh1b9lkipEjc8Igb3DDFjqoPCjzTlhT2w627qaYMy1-PZKm7r6Q0V7vGsw8fFFdqInG5Z-sMVHo9BCXXpF0mk6iYiMLYZpQP8pP3_GvJM2Av_gFIRuvWpdRUfnWRnVz-1OdTK7ONURrYGwHKvQ8wYBx4-1fm6t68X1CqSmNwddKmrMuFJJU4ijcXf57RQqTKmgagVQvlW3FbVQZHWdHuIBOckBzWeoJSCzf3pGDrNu7eGAl5QwSgnBy5gGCGd8FmKGI6nAMiSpbdouvmtNqhG2r35TOCeZLlWC5FlP1_uX2ZSE8XWTNxW07mRfEtmiP0FQ7uwuh_pxAsC3vhAeXXMz9ilKgyflxCBWjLE5-aeOWA";

    $this->tokenRefrescar = "Atzr|IwEBID7_2uVRccr-uzHDhm-zPolewOG0GQIhzyGsszpGpw30i5druSfNesxfh0Y0n_E0Uzd-5EgwBUuSNjlYWvmm0EZbgP90I_fef_Oo1VxQJ2hDjC21pxBn2K9unJSsmY04kN5DsBHuGf_DlRcZ3Fg9M8wHhmyNbSALiUIsUgbbQIZ2DNSbYGre3qCXIWI9B5ucAfU8AQ0GOuMX5OjX_uPyRtkgmHwbYyf-g15CdihPy7KHT3gf8okTkECRoEjT2oMw1QuF_DLts5vAwJ7duOODN3f62IqwCPXgrTsTCRmsl9ds0wGyE8QuaTszmmA_UZWHBgiPweLADVrL5ZkdhMX0gWgMPJAa5tAxcUBiuX5wqgoWY7kxoI4cnEdxypdxjP0i_o9-gyi_9ycg4sNwbq7A9evnSO0iJq63axRGQxYvLknE5kIU17zhaC3tWteaWgCf4gYdxN5ipo0UoWHt3F5RmeeIdS724Uz-U1Ueq4ow7LVKVnZJuWcvXuacsKeKCVEynyWR52v-WXu1wwxu2Hq1jMp_Eh_FZbB8txL7zAepo2PwsxUHkJdxG5atJkx3hSuI1G8";

    $this->test2($this->tokenAcceso,$this->tokenRefrescar);


}


public function test2($a ,$b)
{

    $this->config = array(
        "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
        "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
        "region" => "na",
        "accessToken" => $a,
        "refreshToken" => $b,
        "sandbox" => true);


       $test = new Client($this->config);

    echo "<br>";
    print_r($test);

    
}


}

