<?php

if ( ! function_exists('config')) {
    function config($value, $default = null) {
        return Zofe\Deficient\Deficient::Config($value, $default);
    }
}

if ( ! function_exists('view'))  {
    function view($view, $parameters = array(), $code = null) {
        return Zofe\Deficient\Deficient::View($view, $parameters, $code);
    }
}

if ( ! function_exists('validator')) {
    function validator($data, $rules) {
        return Illuminate\Support\Facades\Validator::make($data, $rules);
    }
}

#db
if ( ! function_exists('select')) {
    function select($query, $parameters = array()) {
        return Illuminate\Support\Facades\DB::select($query, $parameters);
    }
}


