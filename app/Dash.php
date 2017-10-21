<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dash extends AbstractPair
{
    /**
     * @var $api Api
     */
    public $api;
    public $buy_from;
    public $buy_to;
    public $sell_from;
    public $sell_to;
    public $pair = 'dash-btc';
    public $cache_delay = 1;


    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->api = new Api();
        $this->buy_from = env('DASH_BUY_FROM');
        $this->sell_from = env('DASH_SELL_FROM');
        $this->buy_to = env('DASH_BUY_TO');
        $this->sell_to = env('DASH_SELL_TO');
    }

    static function RandomSellPrice(){
        $dash = new Dash();
        $price = PriceTools::RandomPrice($dash->sell_from, $dash->sell_to, true);
        echo "Random {$dash->pair} sell price: $price\r\n";
        return $price;
    }

    static function RandomBuyPrice(){
        $dash = new Dash();
        $price = PriceTools::RandomPrice($dash->buy_from, $dash->buy_to, true);
        echo "Random {$dash->pair} buy price: $price\r\n";
        return $price;
    }

    static function BuyMicro(){
	   $dash = new Dash;
       $price = Dash::RandomBuyPrice();
       $size = 0.00011;
       $result = $dash->api->makeOrder('buy', 'dash-btc', $size/$price , $price);
    }

    static function SellMicro(){
       $dash = new Dash();
       $price = Dash::RandomSellPrice();
       $size = 0.00011;
       $amount = $size / $price;
       echo "$amount";
       $result = $dash->api->makeOrder('sell', 'dash-btc', $size / $price , $price);
    }

    static function GetOrdersInfo(){
        $orders = Dash::GetOrders();
        $sellCount = 0;
        $buyCount = 0;
        $buyTotalAmount = 0;
        $sellTotalAmount = 0;
        $buyPriceSumm = 0;
        $sellPriceSumm = 0;
        $DASHInOrders = 0;
        $BTCInOrders = 0;
        if($orders) {
            foreach ($orders as $orderID => $order) {
                switch ($order['type']) {
                    case 'sell':
                        $sellCount++;
                        $sellTotalAmount += $order['amount'];
                        $sellPriceSumm += $order['price'];
                        $DASHInOrders += $order['amount'];
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
            $R .= "DASH in orders: $DASHInOrders \r\n";
            $R .= "BTC in orders: $BTCInOrders \r\n";
            // KV::set('dash_sell_count', $sellCount);
            // KV::set('dash_buy_count', $sellCount);
            // KV::set('dash_in_orders', $DASHInOrders);
            // KV::set('btc_in_orders', $BTCInOrders);
        }else{
            $R = "Not successful request";
        }
        return $R;
    }

    static function GetOrders(){
        $dash = new Dash();
        $R = $dash->api->getOrders($dash->pair, true);
        if ($R['return']){
            return $R['return'];
        }
    }

    static function CancelRandomOrder(){
        $orders = Dash::GetOrders();
        if($orders) {
            $ordersIDs = array_keys($orders);
            $dash = new Dash();
            $dash->api->cancelOrder(VVMHelper::GetRandomArrayValue($ordersIDs));
        }else{
            echo 'Error in order response';
        }
    }

    static function CacheTicker(){
        $dash = new Dash();
        $lastUpdate = KV::get('dash_last_update');
        if(time() - $lastUpdate > $dash->cache_delay*60){
            KV::set('dash_last_update', time());
            Dash::UpdateCache();
        }
    }

    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
