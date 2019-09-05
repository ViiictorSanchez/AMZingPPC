<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;
use App\User;
use App\Seller;
use App\Profile;
use App\Campaign;
use App\Metric;
use App\Mp;
use Illuminate\Support\Facades\Auth;

class PpcManagerController extends Client
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      parent::__construct($this->getConfig());
      $user = User::firstOrFail();
      $this->profileId=1450162622647471;
      //$this->profileId = (int)$user->profile_default;
      $this->doRefreshToken();
      $this->middleware('auth');
    }

    public function getConfig()
    {     
      $access = "Atza|IwEBIJ2V4xmzVzI2B9aiaX63-U5xxqT4jtCUl6vsfJ6_qf1Cn76dGlmnhexYd6p3AwdORZdfHOl4E1qMoQDTle-mMCNr3ubWgmIOs9QJYhAVlmQl1RFlIZqLXSUx4FJT4WKFo1CCi8h9aYwtV4OmBCKTSKW59ktpxrW-iR8BBZJOFlBX9Hijjf9Aqdfonpx6gzqgeb7qdWBLWhQHDKCjSYwwWYO6GiJ3ZbQi3y65wThU0CZ__8V2hzI7zdzbncer-cbHETwjhY3U_FxiZRCvDYe9Xmo6jYryGhZs3uGx-kqtwK5kdRZ1uU5eAHAUYpBrvXB3tqYda9rp1-Aefm8Bl7fCuqT2qT1JeVgbc1PjCCODcEM-6Bnc9nN2oqbInaQC-65wT5Fx9cHDn2Lm-h72felPGXlcCo8itO8wvdN6TGkZPqPP5gRWCzd_FkVRNKZaog-KU9LWiZSvQU8Z92Tsfoyr5NT8B7Eup5dgahdPNKmQVpXqxN9nCJV3XBDtiz7_trRIbBiOEwGXTp1Xw4uHRbulSWeQuU7IYaQBTs7wqy2bgjC9oP0DpesEpFJ6RAMJmB5fSNeUx4G9UBYZUR13R4n4-ks6";
      $refresh = "Atzr|IwEBIEdiw-fwluKw5_M6v4zfxRdyScrnfbKUQyUxgLbIjJCqU0vUBHKMdZRcV5si_hkiQbyyV8LO4MS-HxY9bBlK_1hmj933qZngJw_5ZTNMgKfcBJkbvczFvlcKhFUmaxsQYGQp-e9Z9FBSalEH6H8lE0x50Z08nO0Fbh42Mu-FXv97ZVeyO3jUPZGhotXRvDAmiYOUpzvxb3k1iVw726HGpvxqogteY4DSE0JQmK9J9thSoTerNte1NlylP2xL8XTi137cgPgmic4f3c4qwVNsNx03W9KIo3yuDB-AJJr_7BWn7_IM1nrwZq8QQYLjCqozjCC7vybdkqAaVSMjlQfDT2tf8RDs9tHRenL2Dsaq-01u-q49fbTlQmTI3Q5mS5pezLQz_BDTjhY4BGcDeLAcpkdyUsCe_niId6zDKNyWB_6qp2q0se3IXkxsWDtrBTt18OuDfSyTHdCI0k8bcCIWsx9s-iF_0Jp2fD3y_02sx4viBC5eLL3JbLxQNKF8K8DGN0Auaqi3BpnMV6P2mSVQSN8bj2R5G_lbVp1jIVyltTcL9_VZlCb_ddmQntae1Wdgoo5A7bAQdIrZJZ5OemcfVZqi";
      return $this->config = array(
        "clientId" => "amzn1.application-oa2-client.7f61e9049e4449078be8d6cd1baea0a3",
        "clientSecret" => "3348515b477eef98f572b2221aae1bf78e15698a6831798dfe9b4b784d7ad8c9",
        "region" => "na",
        "accessToken" => $access,
        "refreshToken" => $refresh,
        "sandbox" => false
      );  
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $taken2 = array();
        $taken2 = Seller::select('seller_id','name')->distinct()->get();    
        $nameTagSeller = User::find(Auth::user()->id);
        $profile = Mp::find($nameTagSeller->profile_default);
        $seller = Seller::where('mp_id','=',$nameTagSeller->profile_default)->first();
        return view('admin.ppcmanager', ['taken2' => $taken2, 'profile'=>$profile, 'seller'=>$seller] );
    }

    public function budget(Request $request)
    {      

    $id = $request->id_campaign;
    $budm = $request->bud_mount;
    $bud = $request->budget;
    settype($id,"integer");
    settype($budm,"integer");
    settype($bud,"integer");
    print_r($this->updateCampaigns(
      array(
        array("campaignId" => $id,     
          "dailyBudget" => ($budm*$bud)/100

        ))));

    return redirect('/admin/ppcmanager');

   }

  public function budgetIncrease(Request $request)
  { 
    $id = $request->id_campaign;
    $budm = $request->bud_mount; //return from API real value
    $bud = $request->budget; //return from views
    $dir = $request->dir;
    $value = $request->optionDir;
    
    if($dir === "1"){
      if($value ==="0"){
          $increment = $bud / 100;
          $increment2 = $budm*$increment; 
          $newValue = $budm+$increment2;
          settype($id,"integer");
          settype($budm,"integer");
          settype($bud,"integer");
          settype($budp,"integer");
      
            $this->updateCampaigns(
              array(
                array("campaignId" => $id,     
                  "dailyBudget" => $newValue
        
                )));
         return redirect()->route('/admin/reports');
        }else{
       
          $newValue = $budm+$bud;
          settype($id,"integer");
          settype($budm,"integer");
          settype($bud,"integer");
          settype($budp,"integer");
      
            $this->updateCampaigns(
              array(
                array("campaignId" => $id,     
                  "dailyBudget" => $newValue
        
                )));
        return redirect()->route('/admin/reports');
        }  
    }else{
      if($value ==="0"){
            $budp = $budm - 100;
            $increment = $bud / 100;
            $increment2 = $budm*$increment;
            $newValue = $budm-$increment2;
            settype($id,"integer");
            settype($budm,"integer");
            settype($bud,"integer"); 
            settype($budp,"integer");
        
            $this->updateCampaigns(
              array(
                array("campaignId" => $id,     
                  "dailyBudget" => $newValue
        
                )));
        return redirect()->route('/admin/reports');
        }else{
         if($budm > $bud){
          $newValue = $budm-$bud;
          settype($id,"integer");
          settype($budm,"integer");
          settype($bud,"integer");
          settype($budp,"integer");
      
            $this->updateCampaigns(
              array(
                array("campaignId" => $id,     
                  "dailyBudget" => $newValue
        
                )));
         }
          
         echo "valor no permitido";
         return redirect()->route('/admin/reports');
        }
    }
  }

 public function pauseCamp(Request $request, $id)
 {
   settype($id,"integer");
   $this->updateCampaigns(
    array(
      array("campaignId" => $id,     
        "state" => "paused")));
     
   return redirect('/admin/reports');
 }

 public function pauseAd(Request $request, $ida)
 {
  settype($ida,"integer");
  $this->updateAdGroups(
    array(
      array("adGroupId" => $ida,     
        "state" => "paused")));
  $request->session()->flash('adpau_message', '
    your adgroup has paused!
    ');
  return redirect('/admin/ppcmanager');
}

public function enabledAd(Request $request, $ida)
{


  settype($ida,"integer");
  $this->updateAdGroups(
    array(
      array("adGroupId" => $ida,     
        "state" => "enabled")));
  $request->session()->flash('adena_message', '
    your adgroup has enabled!
    ');
  return redirect('/admin/ppcmanager');
}

public function multiEditCampaigns(Request $request)
  { 
    $id = $request->id_campaign;
    $status = $request->status;
    $budget = $request->budget;
    $startDate = $request->start_date;
    $endDate = $request->end_date;
    foreach($id as $key=>$value){
    
      settype($value,'float');
      settype($budget[$key],'float');
    
      var_dump($value,$budget[$key],$startDate[$key]);
      if( is_null( $startDate[$key] ) && is_null( $endDate[$key] ) ){
        $this->updateCampaigns(
          array(
            array("campaignId" => $value,     
              "dailyBudget" => $budget[$key],
              "state" => $status[$key],
        )));
      }else if( is_null( $endDate[$key] ) ){
        $start = str_replace ('-','',$startDate[$key]);
        echo $start;
        $this->updateCampaigns(
          array(
            array("campaignId" => $value,     
              "dailyBudget" => $budget[$key],
              "state" => $status[$key],
              "startDate" => $start
        )));
      }else if ( !is_null( $startDate[$key] ) ) {
        $start = str_replace ('-','',$startDate[$key]);
        $end = str_replace ('-','',$endDate[$key]);
        if( $start < $end ){
          $this->updateCampaigns(
            array(
              array("campaignId" => $value,     
                "dailyBudget" => $budget[$key],
                "state" => $status[$key],
                "startDate" => $start,
                "endDate" => $end
          )));
        }
      }
    }

    return redirect('/admin/ppcmanager');
  }
  
  public function refreshProfile(Request $request)
  {
    $marketplace = Mp::where('seller_id','=',$request->seller)->where('name','=', $request->amazon)->first();
    $profileIdAux= $marketplace->profile_id;
    User::where('id',Auth::user()->id)->update(['profile_default'=> $profileIdAux ]);
    return redirect()->route('admin/ppcmanager');
  }

public function reports( Request $request )
{
  $dates = $request->dates;
  //get days from server
  if(!empty($dates)){
    $dateIni = reset($dates);
    $dateEnd = end($dates);
    $nameTagSeller = User::find(Auth::user()->id);
    $profile = Mp::find($nameTagSeller->profile_default);
    $dbData = Metric::obtainData(Auth::user()->id,$dateIni,$dateEnd,$profile->profile_id,$profile->seller_id);
  }
  return response()->json([
    'data' => $dbData,
  ]) ;
}

  public function kreport($day){
    $report_day = $this->requestReport(
        "keywords",
        array(
        "reportDate" => $day,
        "campaignType" => "sponsoredProducts",
        "segment"=>"query",
        "metrics" => "keywordId,adGroupId,impressions,clicks,cost,campaignId,attributedUnitsOrdered1d,attributedSales1d,campaignStatus"));
    
        return $report_day;
  }


  public function addCampaignsDB()
  {
    // $AdGroup = $this->listAdGroups(array("stateFilter" => "enabled,archived,paused"));
    // var_dump(json_decode($AdGroup['response']));
    // die();

    $keywords = $this->listBiddableKeywords(array("stateFilter" => "enabled,paused,archived","startIndex"=>"65000"));

    Log::info('Cantidad de filter all');
    Log::info(count(json_decode($keywords['response'])));
    var_dump(json_decode($keywords['response']));
    die();

    // $negativeKeywords = $this->listNegativeKeywords(array("stateFilter" => "enabled,paused,archived"));
    // var_dump(json_decode($negativeKeywords['response']));
    // die();

    // $CampaignNegativeKeywords = $this->listCampaignNegativeKeywords(array("matchTypeFilter" => "negativeExact"));
    // var_dump(json_decode($CampaignNegativeKeywords['response']));
    // die();


    // $report_day = $this->kreport('20190723');
    // var_dump($report_day);
    // $str_arr = explode (":", $report_day['response']);  
    // $str_arr2 = explode(",",$str_arr[1]); 
    // $report_id = str_replace('"', "", $str_arr2[0]);  
    // $metrics = $this->getReport($report_id);
    // var_dump(json_decode($metrics['response'],true));
    // die();

    // die();

    //--------------------------------------------
    $profilesId = $this->listProfiles();
    $arrayProfiles = json_decode($profilesId['response'],true);
    $campaigns = $this->listCampaigns(array("stateFilter" => "enabled,paused,archived"));
    
    $datac = json_decode($campaigns['response'],true);
    Log::info('Cantidad Campanas');
    Log::info(count($datac));
    var_dump($datac);
    die();
      $report_day = $this->requestReport(
        "campaigns",
        array(
        "reportDate" => "20190729",
        "campaignType" => "sponsoredProducts",
        "metrics" => "campaignName,campaignId,campaignStatus"));
        
        $str_arr = explode (":", $report_day['response']);  
      
        $str_arr2 = explode(",",$str_arr[1]);
        $report_id = str_replace('"', "", $str_arr2[0]);
        $metrics = $this->getReport($report_id);
    $datam = json_decode($metrics['response'],true);
    Log::info('Metricas cantidad');
    Log::info(count($datam));
    var_dump($datam);
    die();
    $met = array("met"=>$datam);

    var_dump($datam);
    die();

    foreach($met as $mets){
      foreach($mets as $m){
        
      }
     }
    die();
    $count = 0;
        foreach ($arrayProfiles as $profile){
          $this->profileId = $profile['profileId']; 
          /*********** campañas ************/
          $ar = array("camp"=>$datac); 
          if($count >= 3) die();
          $count++;
          $index = 0;
          
          foreach ( $ar as $item) {
            foreach($item as $element){
              $bandMetrics = $met['met'][$index]; 
             
              $campaign = new Campaign();
              $campaign->id = $element['campaignId'];
              $campaign->profile_id = $this->profileId;
              $campaign->name = $element['name'];
              $campaign->targeting_type = $element['targetingType'];
              $campaign->budget = $element['dailyBudget'];
              $campaign->startDate = $element['startDate'];
              $campaign->endDate = "";
              $campaign->state = $element['state'];
              //$campaign->save();

              $metric = new Metric();
              $metric->impressions = $bandMetrics['impressions'];
              $metric->clicks = $bandMetrics['clicks'];
              $metric->cpc = $bandMetrics['cost'];
              $metric->spend = 1;
              $metric->sales = $bandMetrics['attributedSales1d'];
              $metric->orders = $bandMetrics['attributedUnitsOrdered30d'];
              $metric->campaign_id = $element['campaignId'];
              $metric->date = "20190628";
             // $metric->save();                       
              $index += 1;
            
            }
          }
        }
          exit;


  }

    public function search(Request $request)
    {
        if($request->ajax()){
        $output="";
        $sellers=DB::table('sellers')->where('name','LIKE','%'.$request->search."%")->get();
        if($sellers){ foreach ($sellers as $key => $seller) {
        $output.='<tr>'.
        '<td>'.$seller->name.'</td>'.
        '</tr>';
          }
          return Response($output);
            }   
        }  
    }

    public function bulk_operations(Request $request){
      $budget = $request->value_budget;
      $campaigns = $request->campaigns;
      $action = $request->action;
      $campaigns = explode(",",$campaigns);
      $campaignsUpdate = array();
      foreach ($campaigns as $key => $campaign_id) {
          $db_campaign = Campaign::find($campaign_id);
          $budgetAux = 0;
          if($db_campaign){
              if($action == 1)
                  $budgetAux = $db_campaign->budget + $budget;
              if($action == 2)
                  $budgetAux = $db_campaign->budget + ($db_campaign->budget * ($budget/100));
              if($action == 3)
                  $budgetAux = $budget;
              if($action == 4)
                  $budgetAux = $db_campaign->budget - $budget;
              if($action == 5)
                  $budgetAux = $db_campaign->budget - ($db_campaign->budget * ($budget/100));
              
              $campaign = array("campaignId"=> (int)$campaign_id, 
                            "dailyBudget"=>$budgetAux
                          );
              array_push($campaignsUpdate, $campaign);
          }
      }    
      if(!empty($campaignsUpdate)){
         $campaignsCount = 0;
          $response = $this->updateCampaigns($campaignsUpdate);
          if($response['success'] == true){
              $response = json_decode ($response['response']);
              foreach ( $response as $key => $campaignResponse) {
                  $db_campaign = Campaign::find($campaignResponse->campaignId);
                  $db_campaign->budget = $campaignsUpdate[$key]['dailyBudget'];
                  $db_campaign->save();
                  $campaignsCount++;
                  Log::info('Actualizo campaignId: '.$campaignResponse->campaignId);
              }
          }
          return response()->json(['code'=>'200','count'=>$campaignsCount]);
      }
      return response()->json(['code'=>'200','count'=>0]);
  }

}