<?php
namespace Pinpoint\Validator;

use InvalidArgumentException;

class SanitizerFactory
{
    public static function create($sanitizer, Array $params)
    {
        $classname = 'Pinpoint\\Validator\\Sanitizer\\'
                   . str_replace(' ', '', ucwords(strtolower($sanitizer)));

        if (class_exists($classname)) {
            return new $classname($params);
        } else {
            throw new InvalidArgumentException("Cannot find " . $classname);
        }
    }
}
