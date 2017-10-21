<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dazz extends AbstractPair
{
    /**
     * @var $api Api
     */
    public $api;
    public $buy_from;
    public $buy_to;
    public $sell_from;
    public $sell_to;
    public $pair = 'dazz-btc';
    public $cache_delay = 1;


    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->api = new Api();
        $this->buy_from = env('DAZZ_BUY_FROM');
        $this->sell_from = env('DAZZ_SELL_FROM');
        $this->buy_to = env('DAZZ_BUY_TO');
        $this->sell_to = env('DAZZ_SELL_TO');
    }

    static function RandomSellPrice(){
        $dazz = new Dazz();
        $price = PriceTools::RandomPrice($dazz->sell_from, $dazz->sell_to, true);
        echo "Random {$dazz->pair} sell price: $price\r\n";
        return $price;
    }

    static function RandomBuyPrice(){
        $dazz = new Dazz();
        $price = PriceTools::RandomBuyPrice($dazz->buy_from, $dazz->buy_to, true);
        echo "Random {$dazz->pair} buy price: $price\r\n";
        return $price;
    }

    static function BuyMicro(){
	   $dazz = new Dazz;
       $price = Dazz::RandomBuyPrice();
       $size = 0.0001;
       $result = $dazz->api->makeOrder('buy', 'dazz-btc', $size/$price , $price);
    }

    static function SellMicro(){
       $dazz = new Dazz();
       $price = Dazz::RandomSellPrice();
       $size = 0.0001;
       $amount = $size / $price;
       echo "$amount";
       $result = $dazz->api->makeOrder('sell', 'dazz-btc', $size / $price , $price);
    }

    static function GetOrdersInfo(){
        $orders = Dazz::GetOrders();
        $sellCount = 0;
        $buyCount = 0;
        $buyTotalAmount = 0;
        $sellTotalAmount = 0;
        $buyPriceSumm = 0;
        $sellPriceSumm = 0;
        $DAZZInOrders = 0;
        $BTCInOrders = 0;
        if($orders) {
            foreach ($orders as $orderID => $order) {
                switch ($order['type']) {
                    case 'sell':
                        $sellCount++;
                        $sellTotalAmount += $order['amount'];
                        $sellPriceSumm += $order['price'];
                        $DAZZInOrders += $order['amount'];
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
            $R = "Sell count: $sellCount\r\n";
            $R .= "Buy count: $buyCount\r\n";
            $R .= "Buy average price: $buyAvgPriceF \r\n";
            $R .= "Sell average price: $sellAvgPriceF \r\n";
            $R .= "DAZZ in orders: $DAZZInOrders \r\n";
            $R .= "BTC in orders: $BTCInOrders \r\n";
            // KV::set('dazz_sell_count', $sellCount);
            // KV::set('dazz_buy_count', $sellCount);
            // KV::set('dazz_in_orders', $DAZZInOrders);
            // KV::set('btc_in_orders', $BTCInOrders);
        }else{
            $R = "Not successful request";
        }
        return $R;
    }

    static function GetOrders(){
        $dazz = new Dazz();
        $R = $dazz->api->getOrders($dazz->pair, true);
        if ($R['return']){
            return $R['return'];
        }
    }

    static function CancelRandomOrder(){
        $orders = Dazz::GetOrders();
        if($orders) {
            $ordersIDs = array_keys($orders);
            $dazz = new Dazz();
            $dazz->api->cancelOrder(VVMHelper::GetRandomArrayValue($ordersIDs));
        }else{
            echo 'Error in order response';
        }
    }

    static function CacheTicker(){
        $dazz = new Dazz();
        $lastUpdate = KV::get('dazz_last_update');
        if(time() - $lastUpdate > $dazz->cache_delay*60){
            KV::set('dazz_last_update', time());
            Dazz::UpdateCache();
        }
    }

    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
