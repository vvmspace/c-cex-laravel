<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Not abstract cause of useful
 *
 * Class AbstractPair
 * @package App
 */

class AbstractPair extends Model
{
    public $pair;
    public $config;
    public $api;

    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(!empty($attributes['pair'])){
            $this->pair = $attributes['pair'];
        }
        if(!empty($this->pair)){
            $this->config = config("pairs.{$this->pair}");
        }
        $this->api = new Api();
    }

    static function RandomSellPrice(){
        $pair = new static();
        $price = PriceTools::SatoshiToBTC(RandomizerZ::RandomFactory($pair->config['sell']['from'], $pair->config['sell']['to'], $pair->config['sell']['random']),true);
        echo "Random {$pair->pair} sell price: $price\r\n";
        return $price;
    }

    static function RandomBuyPrice(){
        $pair = new static();
        $price = PriceTools::SatoshiToBTC(RandomizerZ::RandomFactory($pair->config['buy']['from'], $pair->config['buy']['to'], $pair->config['buy']['random']),true);
        echo "Random {$pair->pair} buy price: $price\r\n";
        return $price;
    }

    static function BuyMicro($delay = null){
        $pair = new static();
        if($pair->config['buy']['enabled']){
            $price = static::RandomBuyPrice();
            $size = $pair->config['buy']['size'];
            $pair->api->makeOrder('buy', $pair->pair, $size/$price , $price);
            if($delay){
                sleep($delay);
            }
        }
    }

    static function SellMicro($delay = null){
        $pair = new static();
        if($pair->config['sell']['enabled']) {
            $price = static::RandomSellPrice();
            $size = $pair->config['sell']['size'];
            $pair->api->makeOrder('sell', $pair->pair, $size / $price, $price);
            if($delay){
                sleep($delay);
            }
        }
    }

    static function GetOrdersInfo(){
        $orders = static::GetOrders();
        $sellCount = 0;
        $buyCount = 0;
        $buyTotalAmount = 0;
        $sellTotalAmount = 0;
        $buyPriceSumm = 0;
        $sellPriceSumm = 0;
        $CTOInOrders = 0;
        $BTCInOrders = 0;
        if($orders) {
            foreach ($orders as $orderID => $order) {
                switch ($order['type']) {
                    case 'sell':
                        $sellCount++;
                        $sellTotalAmount += $order['amount'];
                        $sellPriceSumm += $order['price'];
                        $CTOInOrders += $order['amount'];
                        break;
                    case 'buy':
                        $buyCount++;
                        $buyTotalAmount += $order['amount'];
                        $buyPriceSumm += $order['price'];
                        $BTCInOrders += $order['amount'] * $order['price'];
                        break;
                }
            }
            if ($buyCount > 0) {
                $buyAvgPrice = $buyPriceSumm / $buyCount;
            } else {
                $buyAvgPrice = 0;
            }
            if ($sellCount > 0) {
                $sellAvgPrice = $sellPriceSumm / $sellCount;
            } else {
                $sellAvgPrice = 0;
            }
            $sellAvgPriceF = number_format($sellAvgPrice, 8);
            $buyAvgPriceF = number_format($buyAvgPrice, 8);

            // TODO: Refactor

            $R = "Sell count: $sellCount\r\n";
            $R .= "Buy count: $buyCount\r\n";
            $R .= "Buy average price: $buyAvgPriceF \r\n";
            $R .= "Sell average price: $sellAvgPriceF \r\n";
            $R .= "CTO in orders: $CTOInOrders \r\n";
            $R .= "BTC in orders: $BTCInOrders \r\n";
        }else{
            $R = "Not successful request";
        }
        return $R;
    }

    static function GetOrders(){
        $pair = new static();
        $R = $pair->api->getOrders($pair->pair, true);
        if ($R['return']){
            return $R['return'];
        }
    }

    static function CancelRandomOrder($delay = null){
        $orders = static::GetOrders();
        if($orders) {
            $ordersIDs = array_keys($orders);
            $pair = new static();
            $pair->api->cancelOrder(RandomizerZ::GetRandomArrayValue($ordersIDs));
            if($delay){
                sleep($delay);
            }
        }else{
            echo 'Error in order response';
        }
    }

}
