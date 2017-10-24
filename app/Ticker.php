<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    static function Tick(){
        $t=time();
        while (time() < $t + 40){
            Ticker::MicroTick();
        }
    }

    static function MicroTick(){
        $t = 8;
        $r = rand(1,2);
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
        }
    }
}
