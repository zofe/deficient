<?php

if ( ! function_exists('config')) {
    function config($value, $default = null) {
        return Zofe\Deficient\Deficient::Config($value, $default);
    }
}

if ( ! function_exists('view'))  {
    function view($view, $parameters = array()) {
        return Zofe\Deficient\Deficient::View($view, $parameters);
    }
}

if ( ! function_exists('validator')) {
    function validator($data, $rules) {
        return Illuminate\Support\Facades\Validator::make($data, $rules);
    }
}

if ( ! function_exists('select')) {
    function select($query, $parameters = array()) {
        return Illuminate\Support\Facades\DB::select($query, $parameters);
    }
}