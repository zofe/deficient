<?php

require_once __DIR__ . '/vendor/autoload.php';

use Zofe\Deficient\Deficient;


Deficient::boot("./");


route_get('^/$', function () {
    echo blade('hello');
    die;
});

route_get('^/test/(\w+)$', function ($slug) {
    echo blade('hello', array('title'=>$slug, 'content'=>'Hello '.$slug));
    die;
});

route_missing(function() {
    echo blade('error', array(), 404);
    die;
});


route_dispatch();

