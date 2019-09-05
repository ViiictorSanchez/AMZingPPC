<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mp extends Model
{
    protected $table =  'mp';
    protected $primaryKey = 'profile_id';
    
    public static function obtainMp($seller_id, $nameMp){

        return Mp::where('name','=',$nameMp)->where('seller_id','=',$seller_id)->first();


    }
    
    public function seller()
    {
        return $this->belongsTo(Seller::Class);
    }

    public static function exist($id){
        if(Profile::find($id)){
            return true;
        }
        else{
            return false;
        }
    }
}
