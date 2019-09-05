<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\User;
use App\Seller;
use App\Profile;
use App\Metric;
use App\Mp;
use App\Keyword;
use App\keywordMetric;

class AcKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'act:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insertion keywords';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

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
            "keywords",
            array(
            "reportDate" => $day,
            "campaignType" => "sponsoredProducts",
            "metrics" => "keywordId,adGroupId,impressions,clicks,cost,campaignId,attributedUnitsOrdered1d,attributedSales1d"));
        
        return $report_day;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('SI TRABAJO');
        $client = new Client($this->getConfig());
        $client->doRefreshToken();
        $taken = array();
        $taken = User::first();
        $profilesId = $client->listProfiles();
        $arrayProfiles = json_decode($profilesId['response'],true);
        $days = 1;
        $arrayDay = array();
        for( $i = 1; $i <= $days ; $i++ ) {
            array_push($arrayDay,date('Ymd', strtotime('-'.$i.' day', strtotime('now')))); 
        }
        $prossesing = [];
        foreach($arrayProfiles as $profile) {
            
            $client->profileId = $profile['profileId'];
            // //BiddbleKeywords
            // $keywords = $client->listBiddableKeywords(array("stateFilter" => "enabled,paused,archived"));
            // $keywords = json_decode($keywords['response'],true);
            
            // //insert BiddbleKeywords
            // if( !empty( $keywords ) ){
            //     foreach($keywords as $keyword){
            //         if(isset($keyword['keywordId'])){
            //             if( !keyword::exist($keyword['keywordId'])){
            //                 $keywordObj = new Keyword();
            //                 $keywordObj->id          = $keyword['keywordId'];
            //                 $keywordObj->adGroupId   = isset($keyword['adGroupId']) ? $keyword['adGroupId'] : 0;
            //                 $keywordObj->campaignId  = $keyword['campaignId'];
            //                 $keywordObj->keywordText = $keyword['keywordText'];
            //                 $keywordObj->matchType   = $keyword['matchType'];
            //                 $keywordObj->state       = $keyword['state'];
            //                 $keywordObj->bid         = isset($keyword['bid']) ? $keyword['bid'] : 0; 
            //                 $keywordObj->suggestBid  = '0'; 
            //                 $keywordObj->save();   
            //             }else {
            //                 log::info('keyword alrady exist');
            //                 log::info($keyword);
            //             }
            //         } else {
            //             log::info('fail inserting keyword');
            //             log::info($keyword);
            //         }
            //     }
            // }

            // //NegativeKeywords
            // $keywords = $client->listNegativeKeywords(array("stateFilter" => "enabled,paused,archived"));
            // $keywords = json_decode($keywords['response'], true);
            // //insert NegativeKeywords
            // if( !empty( $keywords ) ){
            //     foreach( $keywords as $keyword){
            //         if(isset($keyword['keywordId'])) {
            //             if(!keyword::exist($keyword['keywordId'])){
            //                 $keywordObj = new Keyword();
            //                 $keywordObj->id          = $keyword['keywordId'];
            //                 $keywordObj->adGroupId   = isset($keyword['adGroupId']) ? $keyword['adGroupId'] : 0;
            //                 $keywordObj->campaignId  = $keyword['campaignId'];
            //                 $keywordObj->keywordText = $keyword['keywordText'];
            //                 $keywordObj->matchType   = $keyword['matchType'];
            //                 $keywordObj->state       = $keyword['state'];
            //                 $keywordObj->bid         = isset($keyword['bid']) ? $keyword['bid'] : 0; 
            //                 $keywordObj->suggestBid  = '0';
            //                 $keywordObj->save();
            //             }else {
            //                 log::info('keyword alrady exist');
            //                 log::info($keyword);
            //             }
            //         } else {
            //             log::info('fail inserting keyword');
            //             log::info($keyword);
            //         }
            //     }
            // }
            // //CampaignNegativeKeywords
            // $keywords = $client->listCampaignNegativeKeywords(array("matchTypeFilter" => "negativeExact"));
            // $keywords = json_decode($keywords['response'],true);
            // //insert CampaignNegativeKeywords
            // if( !empty( $keywords ) ){
            //     foreach($keywords as $keyword){
            //         if(isset($keyword['keywordId'])) {
            //             if(!keyword::exist($keyword['keywordId'])){
            //                 $keywordObj = new Keyword();
            //                 $keywordObj->id          = $keyword['keywordId'];
            //                 $keywordObj->adGroupId   = isset($keyword['adGroupId']) ? $keyword['adGroupId'] : 0; 
            //                 $keywordObj->campaignId  = $keyword['campaignId'];
            //                 $keywordObj->keywordText = $keyword['keywordText'];
            //                 $keywordObj->matchType   = $keyword['matchType'];
            //                 $keywordObj->state       = $keyword['state'];
            //                 $keywordObj->bid         = isset($keyword['bid']) ? $keyword['bid'] : 0; 
            //                 $keywordObj->suggestBid  = '0';  
            //                 $keywordObj->save(); 
            //             } else {
            //                 log::info('keyword alrady exist');
            //                 log::info($keyword);
            //             }
            //         } else {
            //             log::info('fail inserting keyword');
            //             log::info($keyword);
            //         }
            //     }
            // }
            
            //get Keywords Metric Reports
            foreach($arrayDay as $day) {
                $client->doRefreshToken();
                $report_day = $this->report($day,$client);
                $str_arr = explode (":", $report_day['response']);  
                $str_arr2 = explode(",",$str_arr[1]); 
                $report_id = str_replace('"', "", $str_arr2[0]);  
                $metrics = $client->getReport($report_id);
                $metrics = json_decode($metrics['response'],true);
                if(isset($metrics['status']) && ($metrics['status']=="IN_PROGRESS" || $metrics['status']=="SUCCESS")){
                    $metrictosasve = [
                        'client' => $client->profileId,
                        'report' => $report_id,
                        'day'    => $day
                    ];
                    // log::info('saved keyword report');
                    // log::info($metrictosasve);
                    array_push($prossesing,$metrictosasve);
                }else{
                    //save Metrics keywords
                    log::info('*********************');
                    Log::info('Metrics Complete');
                    log::info($metrics);
                    log::info('*********************');
                    log::info($profile);
                    foreach($metrics as $met){
                        if(isset($met['keywordId'])){ 
                            if(!keywordMetric::exist($met['keywordId'],$day)){
                                $metric = new keywordMetric();
                                $metric->keyword_id  = $met['keywordId'];
                                $metric->cost        = $met['cost'];
                                $metric->sales       = $met['attributedSales1d'];
                                $metric->clicks      = $met['clicks'];
                                $metric->impressions = $met['impressions'];
                                $metric->orders      = $met['attributedUnitsOrdered1d'];
                                $metric->date_opt    = (new Carbon($day))->format('Ymd');
                                $metric->save();  
                            }                      
                        }else{
                            log::info('no KeyID');
                            log::info($met);
                        }
                    }  
                }
           }
        }  
        log::info('prossesing pending keywords');
        log::info($prossesing);
        //processing pending keywords
        while(!empty($prossesing) ){
            foreach($prossesing as $key=>$report_id){
                $client->profileId = $report_id['client'];
                $metrics = $client->getReport($report_id['report']);
                $metrics = json_decode($metrics['response'],true);
                //if returns data delete element from array and save it 
                if(!(isset($metrics['status']) && ($metrics['status']=="IN_PROGRESS" || $metrics['status']=="SUCCESS"))){
                    unset($prossesing[$key]);
                    //save Metrics keywords
                    foreach($metrics as $met){
                        if(isset($met['keywordId'])){ 
                            if(!keywordMetric::exist($met['keywordId'],$report_id['day'])){
                                $metric = new keywordMetric();
                                $metric->keyword_id  = $met['keywordId'];
                                $metric->cost        = $met['cost'];
                                $metric->sales       = $met['attributedSales1d'];
                                $metric->clicks      = $met['clicks'];
                                $metric->impressions = $met['impressions'];
                                $metric->orders      = $met['attributedUnitsOrdered1d'];
                                $metric->date_opt    = (new Carbon($report_id['day']))->format('Ymd');
                                $metric->save();          
                            }                 
                        }
                    }  
                }
                else{
                    Log::info('Metrics Status failed!');
                    log::info($metrics['status']);
                }
            }
        } 
        log::info('finish pending keywords');
    }
}
