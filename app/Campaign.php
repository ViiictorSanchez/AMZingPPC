<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Metric;
use App\Profile;
class Campaign extends Model
{
    public function metrics()
    {
        return $this->hasMany('App\Metric');
    }
    public function profile()
    {
        return $this->belongsTo('App\Profile'); 
    }

    public static function exits($id,$date){
        if(Metric::where('date','=',$date)->where('campaign_id','=',$id)->first()){
            return true;
        }
        else{
            return false;
        }
    }

    public static function updatena($id,$profile){
        $var=Campaign::find($id);
        $var->profile_id=$profile;
        $var->save();
    }

    public static function exist($id){
        if(Campaign::find($id)){
            return true;
        }
        else{
            return false;
        }
    }
  
    
}
