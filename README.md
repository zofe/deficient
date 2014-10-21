Deficient
============

It's class that give you some of laravel (4.1) components, without the entire environment.  
You can also add some other package because I keepd the IOC and service-provider booting.  
It has also some helper to keep a concise syntax.

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
    /lang
        /en
           validation.php
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


//booting from current directory 
Deficient::boot("./");

//db stuff
$results = select('select * from mytable');

//validation
$validator = validator(array('title'=>'abc','description'=>'descr...'), 
                             array('title'=>'required|min:4','description'=>'required'));
if ($validator->fails()){
    dd( $validator->messages() );
}

//translation (return 'thankyou' value @ current locale: /lang/en/messages.php )
echo trans('messages.thankyou');

//eloquent
$users = User::all();

//blade
echo view('hello', compact('results','users'));
```

You can also use laravel Facades, declaring namespaces, i.e.:

```php
<?php

use Zofe\Deficient\Deficient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
...

$validator = Validator::make(....
$results = DB::select(....

```

Other files you need are simple to understand (and common use for laravel users):

```php

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


#validation.php

//copy and paste the one in laravel 4.1  
```
