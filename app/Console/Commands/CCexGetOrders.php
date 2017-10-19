<?php

namespace App\Console\Commands;

use App\Api;
use Illuminate\Console\Command;

class CCexGetOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c-cex:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return voids
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $api = new Api();
        $orders = $api->getOrders('cto-btc', true);
        $sellCount = 0;
        $buyCount = 0;
        $buyTotalAmount = 0;
        $sellTotalAmount = 0;
        $buyPriceSumm = 0;
        $sellPriceSumm = 0;
        $CTOInOrders = 0;
        $BTCInOrders = 0;
        if($orders['return']) {
            foreach ($orders['return'] as $orderID => $order) {
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
            echo "Sell count: $sellCount\r\n";
            echo "Buy count: $buyCount\r\n";
            echo "Buy average price: $buyAvgPriceF \r\n";
            echo "Sell average price: $sellAvgPriceF \r\n";
            echo "CTO in orders: $CTOInOrders \r\n";
            echo "BTC in orders: $BTCInOrders \r\n";
        }else{
            echo "Not successful request";
        }
    }
}
