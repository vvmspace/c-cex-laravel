<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceTools extends Model
{
    static function SatoshiToBTC($satoshi){
        return $satoshi * 0.00000001;
    }

    static function RandomPrice($from, $to){
        return PriceTools::SatoshiToBTC(rand($from, $to));
    }
}
