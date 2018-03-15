<?php

namespace App;

class Pai extends AbstractPair
{
    public $pair = 'cto-btc';

    /**
     * @deprecated
     */
    static function CacheTicker(){
        $pai = new Pai();
        $lastUpdate = KV::get('pai_last_update');
        if(time() - $lastUpdate > $pai->cache_delay*60){
            KV::set('pai_last_update', time());
            Pai::UpdateCache();
        }
    }

    /**
     * @deprecated
     */
    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
