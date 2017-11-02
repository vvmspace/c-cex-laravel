<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 50,
            'to' => 70,
            'size' => 0.00015,
            'random' => 'classic',
            'till' => 1509494400
        ],
        'sell' => [
            'enabled' => true,
            'from' => 75,
            'to' => 90,
            'size' => 0.001,
            'random' => 'classic'
        ]
    ],
    'brit-btc' => [
        'class' => 'Brit',
        'buy' => [
            'enabled' => true,
            'from' => 180,
            'to' => 220,
            'size' => 0.0005,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 280,
            'to' => 345,
            'size' => 0.001,
            'random' => 'classic'
        ]
    ],
    'dash-btc' => [
        'class' => 'Dash',
        'buy' => [
            'enabled' => true,
            'from' => 0.044 * 100000000,
            'to' => 0.04575 * 100000000,
            'size' => 0.0001,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 0.0465 * 100000000,
            'to' => 0.047 * 100000000,
            'size' => 0.001,
            'random' => 'classic'
        ]
    ]
];