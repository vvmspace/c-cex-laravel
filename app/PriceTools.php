<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RandomizerZ;

class PriceTools extends Model
{
    static function SatoshiToBTC($satoshi){
        return $satoshi * 0.00000001;
    }

    static function RandomPrice($from, $to, $asString = false){
        $randomPrice = PriceTools::SatoshiToBTC(rand($from, $to));
        return $asString ? number_format($randomPrice, 8) : $randomPrice;
    }
    static function RandomBuyPrice($from, $to, $asString = false){
        $randomPrice = PriceTools::SatoshiToBTC(RandomizerZ::LowRandom($from, $to));
        return $asString ? number_format($randomPrice, 8) : $randomPrice;
    }
    static function RandomSellPrice($from, $to, $asString = false){
        $randomPrice = PriceTools::SatoshiToBTC(RandomizerZ::HighRandom($from, $to));
        return $asString ? number_format($randomPrice, 8) : $randomPrice;
    }
}
