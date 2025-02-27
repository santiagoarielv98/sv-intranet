<?php

// config for Altwaireb/World
return [
    'insert_activations_only' => true,
    'countries' => [
        'activation' => [
            'default' => true,
            'only' => [
                'iso2' => ['AR', 'BR', 'CL', 'CO', 'EC', 'PE', 'UY', 'VE'],
                'iso3' => [],
            ],
            'except' => [
                'iso2' => ['BR', 'CL', 'CO', 'EC', 'PE', 'UY', 'VE'],
                'iso3' => [],
            ],
        ],  
        'chunk_length' => 50,
    ],

    'states' => [
        'activation' => [
            'default' => true,
        ],
        'chunk_length' => 200,
    ],

    'cities' => [
        'activation' => [
            'default' => true,
        ],
        'chunk_length' => 200,
    ],
];
