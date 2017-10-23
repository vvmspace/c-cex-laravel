<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    static function Tick(){
        Ticker::MicroTick();
        Ticker::MicroTick();
    }

    static function MicroTick(){
        $t = 8;
        $r = rand(1,2);
        $r = 2;
        switch ($r) {
            case 1:
                Dash::SellMicro();
                sleep($t);
                Dash::BuyMicro();
                sleep($t);
                break;
            case 2:
                Cto::SellMicro();
                sleep($t);
                Cto::BuyMicro();
                sleep($t);
                break;
        }
        Cto::CancelRandomOrder();
        sleep($t);
    }
}
