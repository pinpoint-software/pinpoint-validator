<?php
namespace Pinpoint\Validator;

use InvalidArgumentException;

class SanitizerFactory
{
    public static function create($sanitizer)
    {
        $classname = 'Pinpoint\\Validator\\Sanitizer\\'
                   . str_replace(' ', '', ucwords(strtolower($sanitizer)));

        if (class_exists($classname)) {
            return new $classname();
        } else {
            throw new InvalidArgumentException("Cannot find " . $classname);
        }
    }
}
