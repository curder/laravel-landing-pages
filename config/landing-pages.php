<?php

return [
    /*
     * View dictionary prefix name.
     */
    'prefix' => 'pages',
    /*
     * Set the whoops default page for specific dictionary.
     * For example, users/ belong if having whoops.blade.php, it will return it firstly, otherwise aborting 404 page.
     * Or you can customize file name whoops -> someone.
     */
    'whoops' => 'whoops',

    'database' => [
        'connection' => '',
        'landing_pages_table' => 'landing_pages',
        'default_template' => 'landing-page::home',
        'templates' => [
            'landing-page::home' => 'home/pages/landing-page.blade.php',
            'landing-page::mobile' => 'mobile/pages/landing-page.blade.php',
        ],
    ],
];
