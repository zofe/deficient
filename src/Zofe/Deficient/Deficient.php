<?php

namespace Zofe\Deficient;

use Illuminate\Container\Container;
use Illuminate\Config\FileLoader;
use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ClassLoader;
use Illuminate\Support\Facades\Facade;
use Philo\Blade\Blade;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Zofe\Burp\Burp;

class Deficient {
    
    protected static $app; //container
    protected static $config; //config loader
    protected static $view; //blade
    
    public static function boot ($path) {

        $path = rtrim($path,'/').'/';

        $env = self::getEnv();
        
        self::$app = new Container;
        self::$app['app'] = self::$app;
        self::$app['env'] = $env;
        self::$app['path'] = $path;

        //config
        self::bootConfig();

        self::bootClasses();

        self::bootView();
        
        self::bootProviders();

        Facade::setFacadeApplication(self::$app);

    }
    
    //fare un setEnv con closure
    protected static function getEnv() {
        return 'production';
    }

    protected static function bootConfig() {
        
        $loader = new FileLoader(new Filesystem, self::$app['path'] . 'config');
        $config = new Repository($loader, self::$app['env']);

        
        $cg['app.locale'] = $config->get('app.locale');
        $cg['app.fallback_locale'] = $config->get('app.locale');
        $cg['app.timezone'] = $config->get('app.timezone');
        $cg['database.fetch'] = $config->get('database.fetch');
        
        $cg['database.default'] = $config->get('database.default');
        $cg['database.connections'] = $config->get('database.connections');
        self::$app['config'] = $cg;
        self::$config = $config;
        date_default_timezone_set($cg['app.timezone']);
    }

    protected static function bootClasses() {

        
        if (self::$config->get('app.autoload')) {
            $dirs = self::$config->get('app.autoload');
            ClassLoader::register();
            ClassLoader::addDirectories($dirs);
        }
    }
        
    protected static function bootView() {
        self::$view = new Blade(self::$app['path'].self::$config->get('app.views'),
                                self::$app['path'].self::$config->get('app.cache'));
    }
    
    protected static function bootProviders() {
        $providers = self::$config->get('app.providers');

        // Register all providers
        $registered = array();
        foreach ($providers as $provider)
        {
            $instance = new $provider(self::$app);
            $instance->register();
            $registered[] = $instance;
        }

        // Then boot them
        foreach ($registered as $instance)
        {
            $instance->boot();
        }

    }
    
    public static function View($view, $parameters = array(), $code = null, $render = true) {
        if ($code && $code == "404") header("HTTP/1.0 404 Not Found");
        $result = self::$view->view()->make($view, $parameters);
        if ($render) {
            return $result->render();
        }
        return $result;
    }
    
    public static function Config($value, $default = null) {
        return self::$config->get($value, $default);
    } 
    
    public static function app($item = null) {
        if ($item) {
            return self::$app['app'][$item];
        }
        return self::$app['app'];
    }
}