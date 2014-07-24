<?php
namespace Pinpoint\Validator\Sanitizer;

class Numeric implements Sanitizer
{
    public function sanitize($value)
    {
        return filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
    }
}
