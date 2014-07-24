<?php
namespace Pinpoint\Validator;

use InvalidArgumentException;

class ConstraintFactory
{
    public static function create($constraint, $params)
    {
        $classname = 'Pinpoint\\Validator\\Constraint\\'
                   . str_replace(' ', '', ucwords(strtolower($constraint)));

        if (class_exists($classname)) {
            return (new $classname())->setParams($params);
        } else {
            throw new InvalidArgumentException("Cannot find " . $classname);
        }
    }
}
