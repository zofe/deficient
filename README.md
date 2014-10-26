Deficient
============

Deficient give you some of laravel components, without the entire environment.  
You can also add some other package because I keepd the IOC and service-provider booting.  
It has also some helper to keep a concise syntax.

Basically you'll get:

 - eloquent
 - validation
 - translation
 - blade
 - [burp](https://github.com/zofe/burp) (a tiny, non blocking, router)
  
## why

In some cases, with big projects, you can't switch to Laravel from start, you need to move step by step, section by section. In some other, you need just a great ORM, or/and template engine, or form validation, translations.. but not a "framework".

Think to "deficient" as a way to use laravel without move to laravel, or (better) a way to embrace laravel slowly and quietly using each component when, where and how you like in your current app.  

On the other hand:
 - deficient make a vendor of __3.5 mb__
 - laravel build a vendor of __20 mb__  
 
 (using illuminate components of 4.1 version for both)


## Installation

install via composer creating or adding dependency to your composer.json:

```
{
    "require": {
        "zofe/deficient": "dev-master"
    }
}
```

then running ```composer install```


## usage 


you can setup a basic file structure, to store configurations, views, language files, and models.  
The suggestd one is: 

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


To create this structure you can simply run a setup command:  
(__important__: be sure that you've no folders conflict with your current application)

    php vendor/zofe/deficient/deficient setup:folders
    
You must set write permission to /cache folder.  
Then you can make an index.php in your root or use Deficient where you want in your project:


```php

<?php
#index.php

require_once __DIR__ . '/vendor/autoload.php';

use Zofe\Deficient\Deficient;


//booting from current directory (needed to find config and other folders)
Deficient::boot("./");

//db stuff
$results = select('select * from mytable');

//validation
$validator = validator(array('title'=>'abc','description'=>'description bla b...'), 
                       array('title'=>'required|min:4','description'=>'required'));
if ($validator->fails()){
    dd( $validator->messages() );
}

//translation (return 'thankyou' value @ current locale: /lang/en/messages.php )
echo trans('messages.thankyou');

//eloquent
$users = User::all();

//blade
echo blade('hello', compact('results','users'));
```
## Laravel Facades
You can also use laravel Facades, declaring or using full namespaces, i.e.:

```php
<?php

use Zofe\Deficient\Deficient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
...

$validator = Validator::make(....
$results = DB::select(....

```
## Need a Router?  
Deficient comes without laravel router, but it has simple alternative: [burp](https://github.com/zofe/burp) router.  
So you can do something like this:

```php
..

Deficient::boot("./");

route_get('^/user/(\d+)$', function( $id ) {
    $user = User::find($id);
    echo blade('user_detail', compact('user'));
});

route_post('^/user/(\d+)$', function( $id ) {
    $user = User::find($id)->update($_POST);
    echo blade('user_detail', compact('user'));
});

route_missing(function() {
    echo blade('error', array(), 404);
    die;
});

route_dispatch();

```

To create a basic index.php, .htaccess, and some route you can use this command  
(__important__: be sure that you've no index.php and .htaccess in your current application)

    php vendor/zofe/deficient/deficient setup:router

