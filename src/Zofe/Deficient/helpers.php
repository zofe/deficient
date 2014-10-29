<?php

if ( ! function_exists('config')) {
    function config($value, $default = null) {
        return Zofe\Deficient\Deficient::Config($value, $default);
    }
}

if ( ! function_exists('app')) {
    function app($item = null) {
        return Zofe\Deficient\Deficient::app($item);
    }
}

if ( ! function_exists('blade'))  {
    function blade($view, $parameters = array(), $code = null, $render = true) {
        return Zofe\Deficient\Deficient::View($view, $parameters, $code, $render);
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


if ( ! function_exists('document_code')) {
    function document_code($file, $start = 0, $end = null) {
        if (!file_exists($file)) {
            return "";
        }
        
        if ($end>0) {
            $code = '';
            $fileobj = new SplFileObject($file);
            $iterator = new LimitIterator($fileobj, $start, $end);
            foreach($iterator as $line) {
                $code .= $line;
            }
        } else {
            $code = file_get_contents($file);            
        }
        $code = preg_replace("#{{ document_code(.*) }}#Us", '', $code);
        $code = highlight_string($code, true);
        return basename($file)."<pre>\n" . $code . "\n</pre>";
    }
}

if ( ! function_exists('document_method')) {
    function document_method($class, $methods)
    {
        $rclass = new ReflectionClass($class);
        $definition = implode("", array_slice(file($rclass->getFileName()), $rclass->getStartLine() - 1, 1));
        $code = "\n" . $definition . "\n....\n\n";

        if (!is_array($methods))
            $methods = array($methods);

        foreach ($methods as $method) {
            $method = new ReflectionMethod($class, $method);
            $filename = $method->getFileName();
            $start_line = $method->getStartLine() - 1;
            $end_line = $method->getEndLine();
            $length = $end_line - $start_line;
            $source = file($filename);
            $content = implode("", array_slice($source, $start_line, $length));

            $code .= $content . "\n\n";
        }

        $code = highlight_string("<?php " . $code, true);
        $code = str_replace('&lt;?php&nbsp;', '', $code);
        return "<pre>\n" . $code . "\n</pre>";
    }
}