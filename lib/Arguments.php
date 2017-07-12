<?php

namespace SaschaEnde\Easydoctor;

class Arguments
{

    private static $args = [];

    public static function getArguments()
    {
        // p: (required parameter with value)
        // v (optional parameter without value)
        // h (optional parameter without value)
        self::$args = getopt('p:',['verbose','noshl']);
    }

    public static function get($key){
        if(!empty(self::$args[$key])){
            return self::$args[$key];
        }
        elseif(isset(self::$args[$key])){
            return true;
        }

    }

}