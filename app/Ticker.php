<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    static function Tick(){
        // $lastTick =  KV::get('last_tick');
        // KV::set('last_tick', time());
        Cto::CancelRandomOrder();
        sleep(10);
        Cto::SellMicro();
        sleep(10);
        Cto::BuyMicro();
        sleep(10);
        Dazz::CancelRandomOrder();
        sleep(10);
        Dazz::SellMicro();
        sleep(10);
        Dazz::BuyMicro();
        sleep(10);
        // Cto::CacheTicker();
    }
}
