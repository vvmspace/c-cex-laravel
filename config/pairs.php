<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 78,
            'to' => 85,
            'size' => 0.00011,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 95,
            'to' => 100,
            'size' => 0.00011,
            'random' => 'classic'
        ]
    ],
    'brit-btc' => [
        'class' => 'Brit',
        'buy' => [
            'enabled' => false,
            'from' => 180,
            'to' => 220,
            'size' => 0.0005,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => false,
            'from' => 280,
            'to' => 345,
            'size' => 0.001,
            'random' => 'classic'
        ]
    ],
    'dash-btc' => [
        'class' => 'Dash',
        'buy' => [
            'enabled' => false,
            'from' => 0.0300 * 100000000,
            'to' => 0.0360 * 100000000,
            'size' => 0.0001,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => false,
            'from' => 0.0385 * 100000000,
            'to' => 0.047 * 100000000,
            'size' => 0.0003,
            'random' => 'classic'
        ]
    ]
];