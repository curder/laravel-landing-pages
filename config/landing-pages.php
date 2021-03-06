<?php

return [
    /*
     * View dictionary prefix name.
     */
    'prefix' => 'pages',

    'url_html_suffix' => env('LP_URL_HTML_SUFFIX', ''),

    /*
     * Set the whoops default page for specific dictionary.
     * For example, users/ belong if having whoops.blade.php, it will return it firstly, otherwise aborting 404 page.
     * Or you can customize file name whoops -> someone.
     */
    'whoops' => 'whoops',

    'database' => [
        'connection' => '',
        'landing_pages_table' => 'landing_pages',
        'default_template' => 'www.example',
        'templates' => [
            'www.example' => 'www/example.blade.php',
            'mobile.example' => 'mobile/example.blade.php',
        ],
    ],
];
