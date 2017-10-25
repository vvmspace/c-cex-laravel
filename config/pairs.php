<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 10,
            'to' => 150,
            'size' => 0.00015,
            'random' => 'classic'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 165,
            'to' => 200,
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