<?php

namespace SaschaEnde\Easydoctor;

class Arguments
{

    private static $args = [];

    public static function getArguments()
    {
        for ($i = 0; $i < count($_SERVER['argv']); $i++) {
            if (substr($_SERVER['argv'][$i], 0, 1) == '-' && !empty($_SERVER['argv'][$i + 1])) {
                $argument = substr($_SERVER['argv'][$i], 1);
                $value = $_SERVER['argv'][$i + 1];
                self::$args[$argument] = $value;
            }
        }
    }

    public static function get($key){
        return self::$args[$key];
    }

}