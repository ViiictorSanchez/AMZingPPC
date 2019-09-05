<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Campaign;
use App\Keywords;
class keywordMetric extends Model
{
    protected $table = 'keyword_metrics';

    public static function obtainData($userId,$dateIni,$dateEnd=null,$profileId,$sellerId){
        if($dateEnd!=null){
            //day range
            $select_raw  =' keywords.id as id, campaigns.name as name, keywords.adGroupId as adGroupId, keywords.keywordText as keywordText,';
            $select_raw .=' keywords.matchType as matchType, keywords.state as state, keywords.suggestBid as suggestBid,';
            $select_raw .=' keywords.bid as dailyBudget,sum(keyword_metrics.impressions) as impressions,';
            $select_raw .=' sum(keyword_metrics.clicks) as clicks, round(sum(keyword_metrics.cost),2) as spend,';
            $select_raw .=' sum(keyword_metrics.orders) as orders, sum(keyword_metrics.sales) as sales';
            $nameTagSeller = DB::table('keyword_metrics')
            ->selectRaw($select_raw)
            ->join('keywords','keyword_metrics.keyword_id',"=",'keywords.id')
            ->join('campaigns','keywords.campaignId','=','campaigns.id')
            ->where('campaigns.profile_id','=',$profileId)
            ->where('campaigns.seller_id','=',$sellerId)
            ->whereBetween('keyword_metrics.date_opt',[$dateIni,$dateEnd])
            ->groupBy('keywords.id')
            ->get();  
        }else{
            //one day 
            $select_raw  =' keywords.id as id, campaigns.name as name, keywords.adGroupId as adGroupId,keywords.keywordText as keywordText,';
            $select_raw .=' keywords.matchType as matchType ,keywords.state as state, keywords.suggestBid as suggestBid,';
            $select_raw .=' keywords.bid as dailyBudget,sum(keyword_metrics.impressions) as impressions,';
            $select_raw .=' sum(keyword_metrics.clicks) as clicks, round(sum(keyword_metrics.cost),2) as spend,';
            $select_raw .=' sum(keyword_metrics.orders) as orders, sum(keyword_metrics.sales) as sales';
            $nameTagSeller = DB::table('keyword_metrics')
            ->selectRaw($select_raw)
            ->join('keywords','keyword_metrics.keyword_id',"=",'keywords.id')
            ->join('campaigns','keywords.campaignId','=','campaigns.id')
            ->where('campaigns.profile_id','=',$profileId)
            ->where('campaigns.seller_id','=',$sellerId)
            ->where('keyword_metrics.date_opt','=',$dateIni )
            ->groupBy('keywords.id')
            ->get(); 
        }
        
       return $nameTagSeller;
    }
    
    //if exist keyword metric in DB
    public static function exist($id,$date){
        if(keywordMetric::where('date_opt','=',$date)->where('keyword_id','=',$id)->first()){
            return true;
        }
        else{
            return false;
        }
    }
}
