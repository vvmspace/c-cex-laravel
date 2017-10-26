<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 10,
            'to' => 120,
            'size' => 0.00015,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 148,
            'to' => 160,
            'size' => 0.00015,
            'random' => 'classic'
        ]
    ],
    'brit-btc' => [
        'class' => 'Brit',
        'buy' => [
            'enabled' => true,
            'from' => 165,
            'to' => 385,
            'size' => 0.00015,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 400,
            'to' => 450,
            'size' => 0.00015,
            'random' => 'classic'
        ]
    ],
    'dash-btc' => [
        'class' => 'Dash',
        'buy' => [
            'enabled' => true,
            'from' => 0.048 * 100000000,
            'to' => 0.0502 * 100000000,
            'size' => 0.0003,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 0.0508 * 100000000,
            'to' => 0.055 * 100000000,
            'size' => 0.0003,
            'random' => 'classic'
        ]
    ]
];