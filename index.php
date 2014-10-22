<?php

require_once __DIR__ . '/vendor/autoload.php';

use Zofe\Deficient\Deficient;


Deficient::boot("./");


get('^/$', function () {
    echo view('hello');
    die;
});

get('^/test/(\w+)$', function ($slug) {
    echo view('hello', array('title'=>$slug, 'content'=>'Hello '.$slug));
    die;
});

missing(function() {
    echo view('error', array(), 404);
    die;
});


dispatch();

