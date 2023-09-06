<?php

return [
    'sets' => [

        'default' => [
            'path' => 'resources/svg',
            'disk' => '',

            'prefix' => 'icon',

            'fallback' => '',

            'class' => '',

            'attributes' => [
                'width' =>'20px',
                'height' => '20px',
            ],
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Global Default Classes
    |--------------------------------------------------------------------------
    |
    | This config option allows you to define some classes which
    | will be applied by default to all icons.
    |
    */

    'class' => '',

    /*
    |--------------------------------------------------------------------------
    | Global Default Attributes
    |--------------------------------------------------------------------------
    |
    | This config option allows you to define some attributes which
    | will be applied by default to all icons.
    |
    */

    'attributes' => [
        // 'width' => 50,
        // 'height' => 50,
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Fallback Icon
    |--------------------------------------------------------------------------
    |
    | This config option allows you to define a global fallback
    | icon when an icon in any set cannot be found. It can
    | reference any icon from any configured set.
    |
    */

    'fallback' => '',

    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    | These config options allow you to define some
    | settings related to Blade Components.
    |
    */

    'components' => [

        /*
        |----------------------------------------------------------------------
        | Disable Components
        |----------------------------------------------------------------------
        |
        | This config option allows you to disable Blade components
        | completely. It's useful to avoid performance problems
        | when working with large icon libraries.
        |
        */

        'disabled' => false,

        /*
        |----------------------------------------------------------------------
        | Default Icon Component Name
        |----------------------------------------------------------------------
        |
        | This config option allows you to define the name
        | for the default Icon class component.
        |
        */

        'default' => 'icon',

    ],

];
