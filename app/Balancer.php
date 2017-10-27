<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Balancer extends Model
{
    public static $balances;

    public static function GetPrettyArray($cached = false){

        /**
         * TODO: refactor
         */

        $prettyArray = [];
        $api = new \App\Api();
        if(!$cached || !static::$balances){
            static::$balances = $api->getBalance()['return'];
        }
        foreach (static::$balances as $balance){
            foreach ($balance as $currency=>$count){
                if ($count > 0) {
                    $prettyArray[$currency] = $count;
                }
            }
        }
        return $prettyArray;

    }
}
