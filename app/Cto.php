<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cto extends Model
{
    protected $api;
    protected $buy_from;
    protected $buy_to;
    protected $sell_from;
    protected $sell_to;


    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->api = new Api();
        $this->buy_from = env('CTO_BUY_FROM');
        $this->sell_from = env('CTO_SELL_FROM');
        $this->buy_to = env('CTO_BUY_TO');
        $this->sell_to = env('CTO_SELL_TO');
    }

    static function RandomSellPrice(){
        $cto = new Cto();
        return PriceTools::RandomPrice($cto->sell_from, $cto->sell_to, true);
    }

    static function RandomBuyPrice(){
        $cto = new Cto();
        return PriceTools::RandomPrice($cto->buy_from, $cto->buy_to, true);
    }

    static function Sell100(){
        $cto = new Cto();
        $cto->api->makeOrder('sell', 'cto-btc', 100 , Cto::RandomSellPrice());
    }

    static function Buy100(){
        $cto = new Cto();
        $cto->api->makeOrder('buy', 'cto-btc', 100 , Cto::RandomBuyPrice());
    }

}
