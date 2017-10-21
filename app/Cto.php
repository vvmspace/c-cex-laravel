<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cto extends Model
{
    /**
     * @var $api Api
     */
    public $api;
    public $buy_from;
    public $buy_to;
    public $sell_from;
    public $sell_to;
    public $pair = 'cto-btc';
    public $cache_delay = 1;


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
        $price = PriceTools::RandomSellPrice($cto->sell_from, $cto->sell_to, true);
        echo "Random sell price: $price\r\n";
        return $price;
    }

    static function RandomBuyPrice(){
        $cto = new Cto();
        $price = PriceTools::RandomBuyPrice($cto->buy_from, $cto->buy_to, true);
        echo "Random buy price: $price\r\n";
        return $price;
    }

    static function BuyMicro(){
	   $cto = new Cto;
       $price = Cto::RandomBuyPrice();
       $size = 0.0002;
       $cto->api->makeOrder('buy', 'cto-btc', $size/$price , $price);
    }

    static function SellMicro(){
       $cto = new Cto();
       $price = Cto::RandomSellPrice();
       $cto->api->makeOrder('sell', 'cto-btc', 0.002 / $price , $price);
    }

    static function GetOrdersInfo(){
        $orders = Cto::GetOrders();
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
            $R = "Sell count: $sellCount\r\n";
            $R .= "Buy count: $buyCount\r\n";
            $R .= "Buy average price: $buyAvgPriceF \r\n";
            $R .= "Sell average price: $sellAvgPriceF \r\n";
            $R .= "CTO in orders: $CTOInOrders \r\n";
            $R .= "BTC in orders: $BTCInOrders \r\n";
            // KV::set('cto_sell_count', $sellCount);
            // KV::set('cto_buy_count', $sellCount);
            // KV::set('cto_in_orders', $CTOInOrders);
            // KV::set('btc_in_orders', $BTCInOrders);
        }else{
            $R = "Not successful request";
        }
        return $R;
    }

    static function GetOrders(){
        $cto = new Cto();
        $R = $cto->api->getOrders($cto->pair, true);
        if ($R['return']){
            return $R['return'];
        }
    }

    static function CancelRandomOrder(){
        $orders = Cto::GetOrders();
        if($orders) {
            $ordersIDs = array_keys($orders);
            $cto = new Cto();
            $cto->api->cancelOrder(VVMHelper::GetRandomArrayValue($ordersIDs));
        }else{
            echo 'Error in order response';
        }
    }

    static function CacheTicker(){
        $cto = new Cto();
        $lastUpdate = KV::get('cto_last_update');
        if(time() - $lastUpdate > $cto->cache_delay*60){
            KV::set('cto_last_update', time());
            Cto::UpdateCache();
        }
    }

    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
