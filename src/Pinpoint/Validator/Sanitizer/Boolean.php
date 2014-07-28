<?php
namespace Pinpoint\Validator\Sanitizer;

class Boolean implements Sanitizer
{
    public function sanitize($value)
    {
        if (is_string($value)) {
            $value = (0 != strcmp(trim(strtolower($value)), 'false'));
        }
        return (bool) $value;
    }
}
