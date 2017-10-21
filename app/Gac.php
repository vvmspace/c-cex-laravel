<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gac extends AbstractPair
{
    /**
     * @var $api Api
     */
    public $api;
    public $buy_from;
    public $buy_to;
    public $sell_from;
    public $sell_to;
    public $pair = 'gac-btc';
    public $cache_delay = 1;


    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->api = new Api();
        $this->buy_from = env('GAC_BUY_FROM');
        $this->sell_from = env('GAC_SELL_FROM');
        $this->buy_to = env('GAC_BUY_TO');
        $this->sell_to = env('GAC_SELL_TO');
    }

    static function RandomSellPrice(){
        $gac = new Gac();
        $price = PriceTools::RandomPrice($gac->sell_from, $gac->sell_to, true);
        echo "Random {$gac->pair} sell price: $price\r\n";
        return $price;
    }

    static function RandomBuyPrice(){
        $gac = new Gac();
        $price = PriceTools::RandomPrice($gac->buy_from, $gac->buy_to, true);
        echo "Random {$gac->pair} buy price: $price\r\n";
        return $price;
    }

    static function BuyMicro(){
	   $gac = new Gac;
       $price = Gac::RandomBuyPrice();
       $size = 0.00011;
       $result = $gac->api->makeOrder('buy', 'gac-btc', $size/$price , $price);
    }

    static function SellMicro(){
       $gac = new Gac();
       $price = Gac::RandomSellPrice();
       $size = 0.00011;
       $amount = $size / $price;
       echo "$amount";
       $result = $gac->api->makeOrder('sell', 'gac-btc', $size / $price , $price);
    }

    static function GetOrdersInfo(){
        $orders = Gac::GetOrders();
        $sellCount = 0;
        $buyCount = 0;
        $buyTotalAmount = 0;
        $sellTotalAmount = 0;
        $buyPriceSumm = 0;
        $sellPriceSumm = 0;
        $GACInOrders = 0;
        $BTCInOrders = 0;
        if($orders) {
            foreach ($orders as $orderID => $order) {
                switch ($order['type']) {
                    case 'sell':
                        $sellCount++;
                        $sellTotalAmount += $order['amount'];
                        $sellPriceSumm += $order['price'];
                        $GACInOrders += $order['amount'];
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
            $R .= "GAC in orders: $GACInOrders \r\n";
            $R .= "BTC in orders: $BTCInOrders \r\n";
            // KV::set('gac_sell_count', $sellCount);
            // KV::set('gac_buy_count', $sellCount);
            // KV::set('gac_in_orders', $GACInOrders);
            // KV::set('btc_in_orders', $BTCInOrders);
        }else{
            $R = "Not successful request";
        }
        return $R;
    }

    static function GetOrders(){
        $gac = new Gac();
        $R = $gac->api->getOrders($gac->pair, true);
        if ($R['return']){
            return $R['return'];
        }
    }

    static function CancelRandomOrder(){
        $orders = Gac::GetOrders();
        if($orders) {
            $ordersIDs = array_keys($orders);
            $gac = new Gac();
            $gac->api->cancelOrder(VVMHelper::GetRandomArrayValue($ordersIDs));
        }else{
            echo 'Error in order response';
        }
    }

    static function CacheTicker(){
        $gac = new Gac();
        $lastUpdate = KV::get('gac_last_update');
        if(time() - $lastUpdate > $gac->cache_delay*60){
            KV::set('gac_last_update', time());
            Gac::UpdateCache();
        }
    }

    static function UpdateCache(){
        echo "updating cache\r\n";
    }
}
