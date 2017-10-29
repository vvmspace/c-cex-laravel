<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 35,
            'to' => 55,
            'size' => 0.00015,
            'random' => 'classic',
            'till' => 1509494400
        ],
        'sell' => [
            'enabled' => true,
            'from' => 55,
            'to' => 60,
            'size' => 0.00015,
            'random' => 'classic'
        ]
    ],
    'brit-btc' => [
        'class' => 'Brit',
        'buy' => [
            'enabled' => true,
            'from' => 285,
            'to' => 344,
            'size' => 0.0005,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 345,
            'to' => 350,
            'size' => 0.001,
            'random' => 'high'
        ]
    ],
    'dash-btc' => [
        'class' => 'Dash',
        'buy' => [
            'enabled' => true,
            'from' => 0.046 * 100000000,
            'to' => 0.0475 * 100000000,
            'size' => 0.0003,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 0.0485 * 100000000,
            'to' => 0.0487 * 100000000,
            'size' => 0.0003,
            'random' => 'classic'
        ]
    ]
];