<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
class Seller extends Model
{
    public function profiles()
    {
        return $this->hasMany('App\Profile');
    }

    
    public function user()
    {
        return $this->belongsToMany(User::Class);
    }
    public function mp()
    {
        return $this->belongsTo(Mp::Class);
    }

    public static function exist($id){
        if(Seller::where('seller_id','=',$id)->first())
        {
            return true;
        }
        else {
            return false;
        }
    }

  public static function curl($url) {
        $ch = curl_init($url); // Inicia sesión cURL
        curl_setopt($ch,CURLOPT_ENCODING , "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
        $info = curl_exec($ch);
        curl_close($ch); 
        return $info; 
        }

    public static function updateName($id){
        $url = "https://www.amazon.com/sp?seller=".$id;
           $data =Seller::curl($url);
           $start = strpos($data,'id="sellerName">');
           if( $start !== false ) 
           {
            $end =  strpos($data,'</h1>');
            $len = $end-$start-16;
            $sellerId = substr($data,$start+16,$len);
           }
           else{ $sellerId = 'N/N';}

           $dato=Seller::where('seller_id','=',$id)->first();
           $dato->name=$sellerId;
           $dato->save();
           usleep(10);
    }

    public static function editName(){
        $data=Seller::get();
        foreach ($data as $value) {
            if($value->seller_id==$value->name)
            {
                $data1=Seller::where('seller_id','=',$value->seller_id)->where('name','!=',$value->seller_id)->first();
                $value->name=$data1->name;
                
                $value->save();
            }
            
        }
    }

}
