Deficient
============

It's just an experiment, a class that give you some of laravel (4.1) components, without the entire enviroinment.

You can also add some other package because I keepd the IOC and service-provider booting.


Basically you'll get:

 - eloquent
 - validation
 - translation
 - blade

  
## why

In some cases, with big projects, during refactoring you can't switch to Laravel from start, you need to move step by step.  
In some other, you need just a great ORM, a valid template engine, form validation.. but not a "framework" with it's own router.

## Installation

install via composer adding ```"zofe/deficient": "dev-master"```


## usage 

you need to make a basic file structure the suggestd one is: 


    /config
        app.php
        database.php
    /models
        User.php
    /cache
    /views
        hello.blade.php
    index.php



```php
<?php
#index.php

require_once __DIR__ . '/vendor/autoload.php';

use Zofe\Deficient\Deficient;
use Illuminate\Support\Facades\DB;

//booting providers
Deficient::boot(__DIR__);

//db stuff
$results = DB::select('select * from mytable');

//eloquent
$users = User::all();


//blade
echo Deficient::view('hello', compact('results','users'));



#app.php

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
    
    'autoload'  => array(
        'models',
    )
);



#dataabase.php

return array(

    'fetch' => PDO::FETCH_CLASS,
    'default' => 'mysql',
    'connections' => array(
        'driver' => 'mysql',

        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => __DIR__.'/../database/production.sqlite',
            'prefix'   => '',
        ),

        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'mydatabase',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',

        ),

    ),
);


#User.php

class User extends \Illuminate\Database\Eloquent\Model {
    public $table = 'user_table';
    
}
```
