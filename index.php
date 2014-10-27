<?php

require_once __DIR__ . '/vendor/autoload.php';

use Zofe\Deficient\Deficient;


Deficient::boot("./");


route_get('^/$', array('as'=>'home', function () {
    echo blade('deficient.hello');
    die;
}));

route_get('^/test/(\w+)$', array('as'=>'test', function ($slug) {
    echo blade('deficient.hello', array('title'=>$slug, 'content'=>'Hello '.$slug));
    die;
}));

route_get('^/users$', function () {
    dd( User::all()->toJson());
    die;
});

route_missing(function() {
    echo blade('deficient.error', array(), 404);
    die;
});


route_dispatch();

