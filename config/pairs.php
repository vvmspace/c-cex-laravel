<?php

return [
    'cto-btc' => [
        'buy' => [
            'enabled' => true,
            'from' => 10,
            'to' => 100,
            'size' => 0.0002,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 165,
            'to' => 200,
            'size' => 0.0005,
            'random' => 'classic'
        ]
    ],
    'dash-btc' => [
        'buy' => [
            'enabled' => false,
            'from' => 0.04 * 100000000,
            'to' => 0.047 * 100000000,
            'size' => 0.0005,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => false,
            'from' => 0.052 * 100000000,
            'to' => 0.07 * 100000000,
            'size' => 0.0005,
            'random' => 'high'
        ]
    ]
];