<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 60,
            'to' => 82,
            'size' => 0.001,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 88,
            'to' => 92,
            'size' => 0.000101,
            'random' => 'classic'
        ]
    ],
    'pai-btc' => [
        'class' => 'Pai',
        'buy' => [
            'enabled' => false,
            'from' => 1,
            'to' => 2,
            'size' => 0.000102,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 3,
            'to' => 5,
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
            'enabled' =>  false,
            'from' => 0.041 * 100000000,
            'to' => 0.042 * 100000000,
            'size' => 0.0001,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 0.04309 * 100000000,
            'to' => 0.044 * 100000000,
            'size' => 0.00011,
            'random' => 'classic'
        ]
    ]
];
