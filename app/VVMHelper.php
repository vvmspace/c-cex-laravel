<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VVMHelper extends Model
{
    /**
     * @deprecated
     *
     * Moved to RandomizerZ
     *
     * @param $arr
     * @return mixed
     */
    static function GetRandomArrayValue($arr){
        return $arr[array_rand($arr)];
    }
}
