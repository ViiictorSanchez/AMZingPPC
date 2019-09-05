<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\User;
use App\Seller;
use App\Profile;
use App\Campaign;
use App\Metric;
use App\Mp;
use App\Http\Controllers\Client;
use Carbon\Carbon;

class ActData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'act:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insertion of the data each time a new user registers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    

    /**
     * Execute the console command.
     *
     * @return mixed
     */
        function getConfig()
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
       
       function curl($url) {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_ENCODING , "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $info = curl_exec($ch);
        curl_close($ch); 
        return $info; 
        }

        function report($day,$client){
            $report_day = $client->requestReport(
                "campaigns",
                array(
                "reportDate" => $day,
                "campaignType" => "sponsoredProducts",
                "metrics" => "campaignId,attributedUnitsOrdered1d,attributedSales1d,impressions,clicks,cost"));
            
                return $report_day;
        }

    function handle()
    {
        $client = new Client($this->getConfig());
        $clientId =$client->getClientId();
        $client->doRefreshToken();
        $profilesId = $client->listProfiles();
        $arrayProfiles = json_decode($profilesId['response'],true);
        $prossesing = [];
          //  profiles  
        foreach ( $arrayProfiles as $item)
        {
            if(!Mp::exist($item['profileId'])){
                $profile = new Mp();
                $profile->name = $item['countryCode'];
                $profile->profile_id = $item['profileId'];           
                if(array_key_exists("sellerStringId",$item['accountInfo'])){   
                    $profile->seller_id = $item['accountInfo']['sellerStringId'];
                    $profile->save();
                    $sellerName = new Seller();
                    $sellerName->users_id = 1;
                    $sellerName->seller_id = $item['accountInfo']['sellerStringId'];
                    $sellerName->name = $item['accountInfo']['sellerStringId'];
                    $sellerName->mp_id = $item['profileId'];
                    $sellerName->save(); 
                }else{          
                    $profile->seller_id = $item['accountInfo']['brandEntityId'];
                    $profile->save();
                    $sellerName = new Seller();
                    $sellerName->users_id = 1;
                    $sellerName->seller_id = $item['accountInfo']['brandEntityId'];
                    $sellerName->name = $item['accountInfo']['brandEntityId'];
                    $sellerName->mp_id = $item['profileId'] ;
                    $sellerName->save();       
                }                 
            } 
        } 
    //seller
         if($profilesId['code'] === 200){
            $taken = array(); $taken3 = array();
            foreach($arrayProfiles as $key => $item) {
                if(array_key_exists("sellerStringId",$item['accountInfo'])){
                    if(!in_array($item['accountInfo'], $taken)) {
                    $taken[] = $item['accountInfo'];
                    $taken3[] = $item['countryCode'];
                } else {
                    unset($items[$key]);
                } 
                $taken2 = array();
                foreach($taken as $key2 => $item) {
                    if(!in_array($item['sellerStringId'], $taken2)) {
                        $taken2[] = $item['sellerStringId'];
                        } 
                    }             
                }
            }
            $taken2 = Seller::get();
            foreach( $taken2 as $item ){
                if($item->seller_id == $item->name || $item->name=='N/N'){
                    Seller::updateName($item->seller_id);
                }
            }  
           Seller::editName();
       }  
       //  set days to sync
        $days = 1;
        $arrayDay = array();
        for( $i = 1; $i <= $days ; $i++ ) {
            array_push($arrayDay,date('Ymd', strtotime('-'.$i.' day', strtotime('now')))); 
        }
     
       // campaings and metrics
        foreach ( $arrayProfiles as $item ){
            $client->doRefreshToken();
            $client->profileId = $item['profileId'];
            $wait=1;
            $campaigns=false;
            //get campaigns
            $campaigns = $client->listCampaigns(array("stateFilter" => "enabled,paused,archived"));
            $campaigns = json_decode($campaigns['response'],true);
            //save Campaigns
            if(!empty($campaigns)){ 
                foreach ( $campaigns as $key=>$element) {
                    if(!(Campaign::exist($element['campaignId']))){
                        $campaign = new Campaign();
                        $campaign->id = $element['campaignId']; 
                        $campaign->profile_id = $item['profileId'];
                        $campaign->seller_id = isset( $item['accountInfo']['sellerStringId']) ? $item['accountInfo']['sellerStringId'] : $item['accountInfo']['brandEntityId'];        
                        $campaign->name = $element['name'];
                        $campaign->targeting_type = $element['targetingType'];
                        $campaign->startDate = $element['startDate'];
                        $campaign->endDate = "";
                        $campaign->state = $element['state'];      
                        $campaign->budget = $element['dailyBudget'];
                        $campaign->save();
                    } 
                }
            }
            //metrics
            foreach($arrayDay as $day) {
                $report_day = $this->report($day,$client);  
                $str_arr = explode (":", $report_day['response']);  
                $str_arr2 = explode(",",$str_arr[1]); 
                $report_id = str_replace('"', "", $str_arr2[0]);  
                $metrics = $client->getReport($report_id);
                $metrics = json_decode($metrics['response'],true);
                if(isset($metrics['status']) && ($metrics['status']=="IN_PROGRESS" || $metrics['status']=="SUCCESS") ){
                    $metrictosasve = [
                        'client' => $client->profileId,
                        'report' => $report_id,
                        'day'    => $day
                    ];
                    log::info('guardo capana en pila');
                    log::info($metrictosasve);
                    array_push($prossesing,$metrictosasve);
                }else{
                    //save Metrics
                    foreach($metrics as $met){
                        if(isset($met['campaignId'])){
                            if(!Metric::exist($met['campaignId'],$day)){
                                $metric = new Metric();
                                $metric->impressions = $met['impressions'];
                                $metric->clicks = $met['clicks'];
                                $metric->spend =  $met['cost'];
                                $metric->sales = $met['attributedSales1d'];
                                $metric->orders = $met['attributedUnitsOrdered1d'];
                                $metric->campaign_id = $met['campaignId'];
                                $metric->date_opt = (new Carbon($day))->format('Ymd');
                                $metric->save();                           
                            }
                        }else{
                            log::info('no consiguio campaignId');
                            log::info($met);
                        }
                    }
                }
            }    
        }  
        //processing pending Campaign metrics
        while( !empty($prossesing) ){
            foreach($prossesing as $key=>$report_id){
                $client->profileId = $report_id['client'];
                $metrics = $client->getReport($report_id['report']);
                $metrics = json_decode($metrics['response'],true);
                //if returns data delete element from array and save it 
                if(!(isset($metrics['status']) && $metrics['status']=="IN_PROGRESS")){
                    unset($prossesing[$key]);
                    //save Metrics keywords
                    foreach($metrics as $met){
                        if(isset($met['campaignId'])){ 
                            if(!Metric::exist($met['campaignId'],$report_id['day'])){
                                $metric = new Metric();
                                $metric->impressions = $met['impressions'];
                                $metric->clicks = $met['clicks'];
                                $metric->spend =  $met['cost'];
                                $metric->sales = $met['attributedSales1d'];
                                $metric->orders = $met['attributedUnitsOrdered1d'];
                                $metric->campaign_id = $met['campaignId'];
                                $metric->date_opt = (new Carbon($report_id['day']))->format('Ymd');
                                $metric->save();                           
                            }
                        }
                    }  
                }
            }
        }
    }
}