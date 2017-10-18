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
}
