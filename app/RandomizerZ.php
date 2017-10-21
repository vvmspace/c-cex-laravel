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

}
