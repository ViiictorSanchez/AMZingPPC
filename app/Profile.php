<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    

    public function campaigns(){
        return $this->hasMany('App\Campaign');
    }
    public  function seller()
    {
        return $this->belongsTo('App\Seller'); 
    }


 
}
