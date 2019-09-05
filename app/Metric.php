<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Campaign;
class Metric extends Model
{
   
    public function campaign()
    {
        return $this->belongsTo('App\Campaign'); 
    }
    public static function obtainData($userId,$dateIni,$dateEnd=null,$profileId,$sellerId){
        if($dateEnd!=null){
            //day range
            $select_raw =' campaigns.id as id,campaigns.startDate as startDate ,campaigns.state as state, campaigns.name as info,';
            $select_raw .='campaigns.budget as dailyBudget, campaigns.targeting_type as targetingType ,';
            $select_raw .=' sum(metrics.impressions) as impressions, sum(metrics.clicks) as clicks, sum(metrics.sales) as sales,';
            $select_raw .=' round(sum(metrics.spend),2) as spend,  sum(metrics.orders) as orders';
            $nameTagSeller = DB::table('metrics')
            ->selectRaw($select_raw)
            ->join('campaigns','metrics.campaign_id',"=",'campaigns.id')
            ->where('campaigns.profile_id','=',$profileId)
            ->where('campaigns.seller_id','=',$sellerId)
            ->whereBetween('metrics.date_opt',[$dateIni,$dateEnd])
            ->groupBy('campaigns.id')
            ->get();  
        }else{
            //one day 
            $select_raw =' campaigns.id as id,campaigns.startDate as startDate ,campaigns.state as state, campaigns.name as info,';
            $select_raw .=' campaigns.budget as dailyBudget, campaigns.targeting_type as targetingType ,';
            $select_raw .=' sum(metrics.impressions) as impressions, sum(metrics.clicks) as clicks, sum(metrics.sales) as sales,';
            $select_raw .=' round(sum(metrics.spend),2) as spend,  sum(metrics.orders) as orders';
            $nameTagSeller = DB::table('metrics')
            ->selectRaw($select_raw)
            ->join('campaigns','metrics.campaign_id',"=",'campaigns.id')
            ->where('campaigns.profile_id','=',$profileId)
            ->where('campaigns.seller_id','=',$sellerId)
            ->where('metrics.date_opt','=',$dateIni )
            ->groupBy('campaigns.id')
            ->get(); 
        }
       return $nameTagSeller;
    }

    public static function exist($id,$date){
        if(Metric::where('date_opt','=',$date)->where('campaign_id','=',$id)->first()){
            return true;
        }
        else{
            return false;
        }
    }
}