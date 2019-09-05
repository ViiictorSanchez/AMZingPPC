<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;



class AmazonController extends Client
{ 


  protected $data = array();

  protected $tokenAcceso = null;

  protected $tokenRefrescar = null;

  protected $codeA = null;

  protected $codeR = null;




  public function __construct()
  {


    parent::__construct($this->getConfig());

   // parent::__construct($this->config);

      // id sandbox
    $this->profileId = "1045898313773529";

    // actualizar tokens nulos automaticamente
    $this->doRefreshToken();

      // $this->profileId = "609638760189820";

      // var_dump($this->getConfig());   

  }

  public function getConfig()
  {     

    $access = "Atza|IwEBIMPqWsXc8Gs8qWk0ebuEWe1wtMdmQMe1KG9I2U70ocMlzGR0gOQzcrFh9duNVRNxhnBXg6iEi79zcw45KrTYzZLZH6n0EBh08G69MVT5QxGBEqTKs3XJek9vRJhqQWGEM0-CoZNYgyxvMKn7aX1csn1QT7UfmpYNS3Hh_vIi0666yeB2bZ5WbbgoTksFLMWBsfjWT11mIGPfvVGbp2XhU5SNZbaa48WEJTiqKcYO-uIf6oKCXtVeDZ6chBFMa0xlP3mPjfgkJV15CMn99uAfaiMblHiEI5JlE8ffVTQ2QXZj9ebvG1nORkhpXK4KSX9sNS2kRa3hIQEXAnRF1Q9kAKSxc6sRrY3oLlhfDEzxCJ_IJ8zqqqXuHRn9b9lO8_BUhBNEReLVc3HiqM5jVfuH4NzEFZBxlSei4tXKpYl8chocv3niATikVgeERGbwAk2Jx8SEwEmUXXH2yKno0PbWepcIqnub9rhoSBDHUbD2A_CVw5bRe43aqSmG1x9TOMCmIMcZUl8q_S_HusaiasFDOcWLfCQJuW_K4UZs32RaYm1NAMB8UgunpOw0DxSSaw_vpz-8EIUWbD3qAtzPKjXr7hR-";

    $refresh = "Atzr|IwEBIESXqc8Ln2sZKcS4Dlu99tcvpsXvHF68RGqWb8r8w6m-gGwBrC_1S2_bOO2D5kH9-fvnov0xlGDupq51ESRH-Wil2gbJzuOeXBlqMh87h6rrGEfC49iE5Db051O88-LHcaBjrhjClUwnBW1KFbqRPvKt2LIOQ0zLIzTlNamEt-MJH1hTuCZEKXxAnNDxChZktH11QHDNGaWQoHLWrcThKuSshzVosiY8XQnssB0Nh5yubGGSYH08O7AnwmtciTEpDKX12uCVSCNFMgK4fFMhLxvgLWO-UJfRrcFRBoNUW0AUirOMCBXU3lZYpZ7FwSQWHNp6RtQTpvQd-8EeggbBSuIvDwnYwsDCTW_MO03qFsl-TM7h8Dmn4OPTv087ECf3eoOrB8-5AB-rmiaj0_imm9hF4Z1wU62EpPwatRy3LnyPEZgNnlmI2TEWa4LzVXUWuEHu5mE-h7hqnv0Wb4PBQZZ4Ntp85N6pcxuaxlEZVmTg8zHTqp3L137zehoiyqKNLO7_ei_L7EC6a1ulHJWIFABc2bo5DDeAt9wOTG1kMV50f5PjusVF0umx1sr5Ikjy5_k";



  // $tokens = json_decode($this->doRefreshToken()['response']);

  // $tokens->access_token;

  // $tokens->refresh_token;

    return $this->config = array(
      "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
      "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
      "region" => "na",
      "accessToken" => $access,
      "refreshToken" => $refresh,
      "sandbox" => false,
      "prod" => true);




  // return $this->config = array(
  //   "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
  //   "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
  //   "region" => "na",
  //   "accessToken" => $tokens->access_token,
  //   "refreshToken" => $tokens->refresh_token,
  //   "sandbox" => true);

    

  }




  public function logAmazon()
  {

    return view('admin.logamazon');
  }


  public function token()
  { 


    print_r($_REQUEST);

    echo "<br>";

    $link ='https://www.amazon.com/ap/oa?client_id=amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3&scope=cpc_advertising:campaign_management&response_type=code&redirect_uri=https://138.197.152.129/code'; 

    echo "<a href='".$link."'>Code</a>";

    exit;



        // aqui obtienes el token por la url
    $c = curl_init('https://api.amazon.com/auth/o2/tokeninfo?access_token=' . urlencode($_REQUEST['access_token']));
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

        // var_dump($c);

    $r = curl_exec($c);
    var_dump($r);

    curl_close($c);

    $d = json_decode($r);




// exchange the access token for user profile
    $c = curl_init('https://api.amazon.com/user/profile');
    curl_setopt($c, CURLOPT_HTTPHEADER, array('Authorization: bearer ' . $_REQUEST['access_token']));
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $r = curl_exec($c);
    curl_close($c);
    $d = json_decode($r);

        // aqui obtienes tu informacion email etc
    echo sprintf('%s %s %s', $d->name, $d->email, $d->user_id);

        // var_dump($d);

  }



  public function code()
  {

    print_r($_REQUEST);

      // print_r($_REQUEST['code']);
    echo "<br>";
    echo "<br>";
    echo "<br>";
    var_dump($_REQUEST['code']);


    $c = curl_init('https://api.amazon.com/auth/o2/token');

    curl_setopt($c, CURLOPT_POST, TRUE);

    curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded;charset=UTF-8'));    

    curl_setopt($c, CURLOPT_POSTFIELDS, 'grant_type=authorization_code&code='.$_REQUEST['code'].'&redirect_uri=https://162.243.173.161/code&client_id=amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3&client_secret=3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9');

    // curl_setopt($c, CURLOPT_URL,"https://api.amazon.com/auth/o2/token");  


     // recibimos la respuesta y la guardamos en una variable
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec ($c);


    curl_close ($c);

    $code = json_decode($response, true);    


    // print_r($code);

    echo "<br>";
    echo "<br>";
    echo "<br>";

    print_r($code['access_token']);

    $this->tokenAcceso = $code['access_token'];

    $acceso = $this->tokenAcceso;  

    echo "<br>";
    echo "<br>";
    echo "<br>";

    print_r($code['refresh_token']);

    $this->tokenRefrescar = $code['refresh_token'];

    $actualizar = $this->tokenRefrescar;



    echo "<br>";
    echo "<br>";
    echo "<br>";


    /***** actualizar el token de acceso *****/

    $c = curl_init('https://api.amazon.com/auth/o2/token');

    curl_setopt($c, CURLOPT_POST, TRUE);

    curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type:application/x-www-form-urlencoded;charset=UTF-8'));    

    curl_setopt($c, CURLOPT_POSTFIELDS, 'grant_type=refresh_token&client_id=amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3&refresh_token='.$code['refresh_token'].'&client_secret=3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9');

    // curl_setopt($c, CURLOPT_URL,"https://api.amazon.com/auth/o2/token");  


     // recibimos la respuesta y la guardamos en una variable
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec ($c);


    curl_close ($c);

    $code = json_decode($response, true);


    print_r($code['access_token']);

    echo "<br>";

    // $this->tokenAcceso = $code['access_token'];



  }


  public function registerPro()
  {

  // $this->registerProfile(array("countryCode" => "IT"));


    print_r($this->registerProfile(array("countryCode" => "IT")));
  }



  public function listPro()
  {

    print_r($this->listProfiles());    

  }




  public function listProById()
  {
      // id proginal no sandbox 609638760189820

    // obtener el perfil por id
    $id = 3985390143818633;
    print_r($this->getProfile($id));     

  }


  public function createCamps(Request $request)
  {
    // print_r($this->createCampaigns(
    //     array(
    //         array("name" => "My Campaign Three",
    //           "campaignType" => "sponsoredProducts",
    //           "targetingType" => "manual",
    //           "state" => "enabled",
    //           "dailyBudget" => 6.00,
    //           "startDate" => date("Ymd")),
    //         array("name" => "My Campaign Four",
    //           "campaignType" => "sponsoredProducts",
    //           "targetingType" => "manual",
    //           "state" => "enabled",
    //           "dailyBudget" => 7.00,
    //           "startDate" => date("Ymd")))));


     // print_r($this->createCampaigns(
     //    array(
     //        array("name" => "My Campaign Five",
     //          "campaignType" => "sponsoredProducts",
     //          "targetingType" => "manual",
     //          "state" => "enabled",
     //          "dailyBudget" => 8.00,
     //          "startDate" => date("Ymd")),
     //        array("name" => "My Campaign Six",
     //          "campaignType" => "sponsoredProducts",
     //          "targetingType" => "manual",
     //          "state" => "enabled",
     //          "dailyBudget" => 9.00,
     //          "startDate" => date("Ymd")))));

     // print_r($this->createCampaigns(
     //    array(
     //        array("name" => "My Campaign Seven",
     //          "campaignType" => "sponsoredProducts",
     //          "targetingType" => "manual",
     //          "state" => "enabled",
     //          "dailyBudget" => 9.00,
     //          "startDate" => date("Ymd")),
     //        array("name" => "My Campaign Eight",
     //          "campaignType" => "sponsoredProducts",
     //          "targetingType" => "manual",
     //          "state" => "enabled",
     //          "dailyBudget" => 10.00,
     //          "startDate" => date("Ymd")))));


      // print_r($this->createCampaigns(
      //   array(
      //       array("name" => "My Campaign Nine",
      //         "campaignType" => "sponsoredProducts",
      //         "targetingType" => "manual",
      //         "state" => "enabled",
      //         "dailyBudget" => 11.00,
      //         "startDate" => date("Ymd")),
      //       array("name" => "My Campaign Ten",
      //         "campaignType" => "sponsoredProducts",
      //         "targetingType" => "manual",
      //         "state" => "enabled",
      //         "dailyBudget" => 12.00,
      //         "startDate" => date("Ymd")))));


        // print_r($this->createCampaigns(
        // array(
        //     array("name" => "My Campaign Seven",
        //       "campaignType" => "sponsoredProducts",
        //       "targetingType" => "manual",
        //       "state" => "enabled",
        //       "dailyBudget" => 13.00,
        //       "startDate" => date("Ymd")),
        //     array("name" => "My Campaign Thein",
        //       "campaignType" => "sponsoredProducts",
        //       "targetingType" => "manual",
        //       "state" => "enabled",
        //       "dailyBudget" => 14.00,
        //       "startDate" => date("Ymd")))));



   print_r($this->createCampaigns(
    array(
      array("name" => "My Campaign tenwty",
        "campaignType" => "sponsoredProducts",
        "targetingType" => "manual",
        "state" => "enabled",
        "dailyBudget" => 14.00,
        "startDate" => date("Ymd")),
      array("name" => "My Campaign levym",
        "campaignType" => "sponsoredProducts",
        "targetingType" => "manual",
        "state" => "enabled",
        "dailyBudget" => 16.00,
        "startDate" => date("Ymd")))));

 }



 public function updatedCamps()
 {

    // $this->updateCampaigns();

  // print_r($this->updateCampaigns(
  //   array(
  //     array("campaignId" => 87482153716122,
  //       "name" => "Update Campaign thein",
  //       "state" => "enabled",
  //       "dailyBudget" => 10.99),
  //     array("campaignId" => 133884316972908,
  //       "name" => "Update Campaign Two",
  //       "state" => "enabled",
  //       "dailyBudget" => 99.99))));

  $id = 87482153716122;

  // print_r(gettype($id));

   // $this->updateCampaigns(
   //  array(
   //    array("campaignId" => $id,
   //      "name" => "Update Campaign test",
   //      "state" => "enabled",
   //      "dailyBudget" => 70.99),
   //    array("campaignId" => 133884316972908,
   //      "name" => "Update Campaign Two",
   //      "state" => "enabled",
   //      "dailyBudget" => 99.99)));


  // print_r( $this->updateCampaigns(
  //   array(
  //     array("campaignId" => 155371894087313,
  //       "name" => "Update Campaign test2",
  //       "state" => "enabled",
  //       "dailyBudget" => 70.99),
  //     array("campaignId" => 243681704951213,
  //       "name" => "Update Campaign test3",
  //       "state" => "enabled",
  //       "dailyBudget" => 1099.99))));


  print_r( $this->updateCampaigns(
    array(
      array("campaignId" => 155371894087313,
        "name" => "Update Campaign test3",
        "state" => "enabled",
        "dailyBudget" => 870.99))));


    // $this->updateCampaigns(
    // array(
    //   array("campaignId" => 155371894087313,
    //     "name" => "Update Campaign test2",
    //     "state" => "enabled",
    //     "dailyBudget" => 70.99),
    //   array("campaignId" => 333884316972903,
    //     "name" => "Update Campaign test3",
    //     "state" => "enabled",
    //     "dailyBudget" => 1099.99)));





  


  // return redirect('/admin/dashboard');




}


public function updatedCampBud(Request $request, $id ,$budget)
{

  // print_r($request);

  // $budget = 1;

  // echo "el id es:".$id;


  // print_r($this->updateCampaigns(
  //   array(
  //     array("campaignId" => $id,        
  //       "dailyBudget" => 70.99))));

  // $this->updateCampaigns(    
  //     array("campaignId" => $id,        
  //       "dailyBudget" => 70.99));


  // $this->updateCampaigns(
  //   array(
  //     array("campaignId" => $id,
  //       "name" => "Update Campaign test",
  //       "state" => "enabled",
  //       "dailyBudget" => 13.99),
  //     array("campaignId" => $id,
  //       "name" => "Update Campaign test",
  //       "state" => "enabled",
  //       "dailyBudget" => 14.99)));


    // $this->updateCampaigns(    
    //   array("campaignId" => $id,
    //     "name" => "Update Campaign test",
    //     "state" => "enabled",
    //     "dailyBudget" => 13.99)
    //  );

  // $param = settype($id,"integer");

  // print_r(gettype($id));

    // settype($id,"integer");

     // print_r($id);

    // print_r($id,$name);

    // print_r(gettype($id));
  // $param = $id;

    // print_r($this->updateCampaigns(    
    //   array("campaignId" => $id,
    //     "name" => "Update Campaign test params",
    //     "state" => "enabled",
    //     "dailyBudget" => 15.69)
    //  ));

     // $aleatorio = rand(5, 14);



 settype($id,"integer");

 settype($budget,"integer");

         // $newId = getrandmax();

     // echo getrandmax();

     // echo $aleatorio;


    //    $this->updateCampaigns(
    // array(
    //   array("campaignId" => $id,
    //     "name" => "Update Campaign test",
    //     "state" => "enabled",
    //     "dailyBudget" => 70.99),
    //   array("campaignId" => $newId,
    //     "name" => "Update Campaign Two",
    //     "state" => "enabled",
    //     "dailyBudget" => 99.99)));


     //       print_r($this->updateCampaigns(    
     //  array("campaignId" => $id,
     //    "name" => "Update Campaign test params",
     //    "state" => "enabled",
     //    "dailyBudget" => 805.69)
     // ));

    // correcto funcionando con parametros
    //            print_r( $this->updateCampaigns(
    // array(
    //   array("campaignId" => $id,
    //     "name" => "Update Campaign param",
    //     "state" => "enabled",
    //     "dailyBudget" => 870.99))));


 // $this->updateCampaigns(
 //  array(
 //    array("campaignId" => $id,     
 //      "dailyBudget" => 10*10)));

 $this->updateCampaigns(
  array(
    array("campaignId" => $id,     
      "dailyBudget" => $budget+10)));


 return redirect('/admin/dashboard');





    //   print_r($this->updateCampaigns(
    // array(
    //   array("campaignId" => $id),
    //   array("campaignId" => $newId))));

    //        $this->updateCampaigns(
    // array(
    //   array("campaignId" => $id),
    //   array("campaignId" => $newId,
    //     "name" => "Update Campaign Test",
    //     "state" => "enabled",
    //     "dailyBudget" => 599.99)));




  // return redirect('/admin/dashboard');




}


public function updatedCampBudDe(Request $request, $id ,$budget)
{

  echo $id;


 // settype($id,"integer");

 // settype($budget,"integer");



 // $this->updateCampaigns(
 //  array(
 //    array("campaignId" => $id,     
 //      "dailyBudget" => $budget-10)));


 // return redirect('/admin/dashboard');



}


public function pauseCamp(Request $request, $id)
{


 settype($id,"integer");

  // settype($state,"string");



 $this->updateCampaigns(
  array(
    array("campaignId" => $id,     
      "state" => "disabled")));


 return redirect('/admin/dashboard');



}


public function reportRe()
{
   // la fecha debe estar en un rango de 60 dias = reportDate
  print_r($this->requestReport(
    "campaigns",
    array("reportDate" => "20190501",
          "campaignType" => "sponsoredProducts",
          "metrics" => "impressions,clicks,cost")));

  // amzn1.clicksAPI.v1.m1.5CD444B4.e3c2f999-14b0-4385-bf71-41f8538f712a
  
    
}





public function report()
{

    print_r($this->getReport("amzn1.clicksAPI.v1.m1.5CD444B4.e3c2f999-14b0-4385-bf71-41f8538f712a"));


    // Array ( [success] => 1 [code] => 200 [response] => [ { "cost": 205.91, "campaignId": 87482153716122, "clicks": 858, "impressions": 17390 }, { "cost": 1180.87, "campaignId": 243681704951213, "clicks": 4072, "impressions": 93520 }, { "cost": 195.59, "campaignId": 155371894087313, "clicks": 1304, "impressions": 56114 }, { "cost": 231.99, "campaignId": 242085894006038, "clicks": 1221, "impressions": 29215 }, { "cost": 336.83, "campaignId": 67594649354726, "clicks": 1604, "impressions": 44044 }, { "cost": 233.73, "campaignId": 41576568977159, "clicks": 806, "impressions": 37460 }, { "cost": 108.29, "campaignId": 133884316972908, "clicks": 637, "impressions": 38903 }, { "cost": 7.42, "campaignId": 231134397724895, "clicks": 53, "impressions": 2478 }, { "cost": 847.25, "campaignId": 214756248813094, "clicks": 3389, "impressions": 80626 }, { "cost": 144.76, "campaignId": 120212699963135, "clicks": 517, "impressions": 11625 }, { "cost": 227.92, "campaignId": 239366711768317, "clicks": 814, "impressions": 23041 } ] [requestId] => C483529270A16B07 )
}





public function listCamps()
{  

  

  $campaigns = $this->listCampaigns(array("stateFilter" => "enabled"));

  $metrics = $this->getReport("amzn1.clicksAPI.v1.m1.5CD444B4.e3c2f999-14b0-4385-bf71-41f8538f712a");



    // return response([$campaigns,$metrics]);

  // gettype($campaigns);

  // print_r(gettype($campaigns));

  // print_r($campaigns);

  // print_r($campaigns['code']);

   print_r($campaigns['response']);

   $data = json_decode($campaigns['response']);

   //  print_r(gettype($re));

     print_r($data);




  // foreach ($data as $camp) {
    
  //   echo $camp->campaignId;
  // }




}



public function refreshToken()
{
    // refrescar el token

 // print_r($this->doRefreshToken());



 echo '<br>';


 // print_r($this->doRefreshToken()['response']);


 echo '<br>';

 $tokens = json_decode($this->doRefreshToken()['response']);

 echo '<br>';

 // print_r($tokens);

 // var_dump($tokens);

 echo '<br>';


  // var_dump($tokens->access_token);

 print_r($tokens->access_token);

 echo '<br>';
 echo '<br>';
 echo '<br>';

   // var_dump($tokens->refresh_token);


 print_r($tokens->refresh_token);



  // print_r(gettype($this->doRefreshToken()));

}

// public function registerProfil()
// {

//   $id = 3985390143818633;   

//   print_r($this->registerProfile($id));


// }



// public function registerProfileSta()
// {

//   $id = 3985390143818633;   

//   print_r($this->registerProfileStatus($id));


// }








}

