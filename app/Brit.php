<?php

namespace App;

class Brit extends AbstractPair
{
    public $pair = 'brit-btc';




    static function CacheTicker(){
        $brit = new Brit();
        $lastUpdate = KV::get('brit_last_update');
        if(time() - $lastUpdate > $brit->cache_delay*60){
            KV::set('brit_last_update', time());
            Brit::UpdateCache();
        }
    }




    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
