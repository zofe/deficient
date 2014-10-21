<?php

return array(
    'locale'          => 'en',
    'fallback_locale' => 'en',
    'views'           => '/views',
    'cache'           => '/cache',

    'providers' => array(
        'Illuminate\Events\EventServiceProvider',
        'Illuminate\Filesystem\FilesystemServiceProvider',
        'Illuminate\Database\DatabaseServiceProvider',
        'Illuminate\Translation\TranslationServiceProvider',
        'Illuminate\Validation\ValidationServiceProvider',
    ),
    
    'autoload'  =>array(
        'models',
    ),
);