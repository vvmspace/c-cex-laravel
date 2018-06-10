<?php

namespace App;

class Cto extends AbstractPair
{
    public $pair = 'cto-btc';
    public $sin_volatility = 20;
    public $sin_delay = 60 * 60 * 2;

    /**
     * @deprecated
     */
    static function CacheTicker(){
        $cto = new Cto();
        $lastUpdate = KV::get('cto_last_update');
        if(time() - $lastUpdate > $cto->cache_delay*60){
            KV::set('cto_last_update', time());
            Cto::UpdateCache();
        }
    }

    /**
     * @deprecated
     */
    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
