<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => false,
            'from' => 10,
            'to' => 120,
            'size' => 0.00015,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 145,
            'to' => 148,
            'size' => 0.00015,
            'random' => 'classic'
        ]
    ],
    'brit-btc' => [
        'class' => 'Brit',
        'buy' => [
            'enabled' => false,
            'from' => 200,
            'to' => 400,
            'size' => 0.00015,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 400,
            'to' => 400,
            'size' => 0.00015,
            'random' => 'classic'
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