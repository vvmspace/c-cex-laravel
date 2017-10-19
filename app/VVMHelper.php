<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VVMHelper extends Model
{
    static function GetRandomArrayValue($arr){
        return $arr[array_rand($arr)];
    }
}
