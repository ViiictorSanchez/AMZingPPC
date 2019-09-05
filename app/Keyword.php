<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public static function exist($id){
        if(keyword::where('id','=',$id)->first()){
            return true;
        }
        else{
            return false;
        }
    }
}
