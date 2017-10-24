<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RandomizerZ extends Model
{
    static function LowRandom($a, $b){
        if($a < $b){
            $min = $a;
            $max = $b;
        }else{
            $min = $b;
            $max = $a;
        }
        return rand($min, rand($min,$max));
    }

    static function HighRandom($a, $b){
        if($a < $b){
            $min = $a;
            $max = $b;
        }else{
            $min = $b;
            $max = $a;
        }
        return rand(rand($min, $max), $max);
    }

    static function RandomFactory($min, $max, $type = 'classic'){
        switch ($type){
            case 'high':
                return self::HighRandom($min, $max);
                break;
            case 'low':
                return self::LowRandom($min, $max);
                break;
            default:
                return rand($min, $max);
                break;
        }
    }

    static function GetRandomArrayValue($arr){
        return $arr[array_rand($arr)];
    }
}
