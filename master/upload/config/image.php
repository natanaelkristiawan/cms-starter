<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
     */

    'driver'    => 'gd',

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    |
    | {route}/{template}/{filename}
    |
    | Examples: "images", "img/cache"
    |
     */

    'route'     => 'image',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited
    | by URI.
    |
    | Define as many directories as you like.
    |
     */

    'paths'     => [
        base_path(env('UPLOAD_FOLDER', 'storage/uploads'))
    ],

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
     */

    'templates' => [
        'xs' => 'Master\Upload\Templates\ExtraSmall',
        'sm' => 'Master\Upload\Templates\Small',
        'md' => 'Master\Upload\Templates\Medium',
        'lg' => 'Master\Upload\Templates\Large',
        'xl' => 'Master\Upload\Templates\ExtraLarge',
        'preview' => 'Master\Upload\Templates\Preview',
        'profile' => 'Master\Upload\Templates\Profile',
        'mobile' => 'Master\Upload\Templates\Mobile'
    ],

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
     */

    'lifetime'  => 43200,

    // Image size
    'size'      => [
        'preview' => [
            'action' => 'fit',
            // 'default'   => 'img/noimage.jpg',
            // 'watermark' => public_path('assets/img/watermark.png'),
        ],
        'xs' => [
            'action' => 'resize',
            // 'default'   => 'img/noimage.jpg',
            // 'watermark' => public_path('assets/img/watermark.png'),
        ],
        'sm' => [
            'action' => 'resize',
            //'default'   => 'img/noimage.jpg',
            //'watermark' => public_path('assets/img/watermark.png'),
        ],
        'md' => [
            'action' => 'resize',
            //'default'   => 'img/noimage.jpg',
            //'watermark' => public_path('assets/img/watermark.png'),
        ],
        'lg' => [
            'action' => 'resize',
            //'default'   => 'img/noimage.jpg',
            //'watermark' => public_path('assets/img/watermark.png'),
        ],
        'xl' => [
            'action' => 'resize',
            //'default'   => 'img/noimage.jpg',
            //'watermark' => public_path('assets/img/watermark.png'),
        ],
        'profile'=> [
            'action' => 'fit',
        ],
        'mobile' => [
            'action' => 'fit'
        ]
    ],
];
