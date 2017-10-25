<?php

return [
    'cto-btc' => [
        'class' => 'Cto',
        'buy' => [
            'enabled' => true,
            'from' => 10,
            'to' => 150,
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
        'class' => 'Dash',
        'buy' => [
            'enabled' => true,
            'from' => 0.045 * 100000000,
            'to' => 0.05 * 100000000,
            'size' => 0.0005,
            'random' => 'low'
        ],
        'sell' => [
            'enabled' => true,
            'from' => 0.051 * 100000000,
            'to' => 0.055 * 100000000,
            'size' => 0.0005,
            'random' => 'high'
        ]
    ]
];