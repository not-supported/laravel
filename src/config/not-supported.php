<?php

return [

    'referrer' => true,

    'custom_referrer' => false,

    'browsers' => [
        'chrome'  => '>=60',
        'firefox' => '>60',
        'edge'    => '>60',
        'opera'   => '>30',
    ],

    /**
     * When a non-specified browser occurs, set this to true
     * if you want to redirect and false if you want to allow it.
     */

    'fallback_browser_should_redirect' => true,
];
