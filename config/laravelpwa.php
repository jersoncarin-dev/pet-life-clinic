<?php

return [
    'name' => 'PETSLIFE CLINIC',
    'manifest' => [
        'name' => env('APP_NAME', 'Pet\'s Life Clinic'),
        'short_name' => 'Pet\'s Life',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/assets/media/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/assets/media/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/assets/media/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/assets/media/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/assets/media/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/assets/media/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/assets/media/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/assets/media/icons/icon-512x512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/assets/media/icons/splash-640x1136.png',
            '750x1334' => '/assets/media/icons/splash-750x1334.png',
            '828x1792' => '/assets/media/icons/splash-828x1792.png',
            '1125x2436' => '/assets/media/icons/splash-1125x2436.png',
            '1242x2208' => '/assets/media/icons/splash-1242x2208.png',
            '1242x2688' => '/assets/media/icons/splash-1242x2688.png',
            '1536x2048' => '/assets/media/icons/splash-1536x2048.png',
            '1668x2224' => '/assets/media/icons/splash-1668x2224.png',
            '1668x2388' => '/assets/media/icons/splash-1668x2388.png',
            '2048x2732' => '/assets/media/icons/splash-2048x2732.png',
        ],
        'custom' => []
    ]
];
