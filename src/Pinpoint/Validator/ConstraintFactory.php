<?php
namespace Pinpoint\Validator;

use InvalidArgumentException;
use Pinpoint\Validator\Constraint\Constraint;

class ConstraintFactory
{
    public static function create($constraint, $params)
    {
        $classname = 'Pinpoint\\Validator\\Constraint\\'
                   . str_replace(' ', '', ucwords(strtolower($constraint)));

        if ($constraint instanceof Constraint) {
            return $constraint;
        } elseif (class_exists($classname)) {
            return (new $classname())->setParams($params);
        } elseif (class_exists($constraint)) {
            return (new $constraint())->setParams($params);
        } else {
            throw new InvalidArgumentException("Cannot find " . $classname);
        }
    }
}
