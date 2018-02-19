<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    static function Tick(){
        $t=time();
        while (time() < $t + 280){
            Ticker::MicroTick();
        }
    }

    static function MicroTick(){
        $t = 15;
        $r = 2;
        switch ($r) {
            case 1:
                Dash::SellMicro($t);
                Dash::BuyMicro($t);
                Dash::CancelRandomOrder($t);
                break;
            case 2:
                Cto::SellMicro($t);
                Cto::BuyMicro($t);
                Cto::CancelRandomOrder($t);
                break;
            case 3:
                Brit::SellMicro($t);
                Brit::BuyMicro($t);
                Brit::CancelRandomOrder($t);
                break;
        }
    }
}
