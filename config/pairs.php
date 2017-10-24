<?php

return [
    'cto-btc' => [
        'buy' => [
            'enabled' => true,
            'from' => 10,
            'to' => 120,
            'size' => 0.0005,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 175,
            'to' => 250,
            'size' => 0.0005,
            'random' => 'high'
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