<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    static function Tick(){
        $lastTick =  KV::get('last_tick');
        KV::set('last_tick', time());
        Cto::CancelRandomOrder();
        sleep(10);
        Cto::Sell100();
        sleep(10);
        Cto::Buy100();
        sleep(10);
        Cto::CancelRandomOrder();
        sleep(10);
        Cto::Sell100();
        sleep(10);
        Cto::Buy100();
        sleep(10);
        Cto::CancelRandomOrder();
        Cto::CacheTicker();
    }
}
