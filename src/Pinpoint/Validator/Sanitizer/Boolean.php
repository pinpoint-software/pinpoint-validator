<?php
namespace Pinpoint\Validator\Sanitizer;

class Boolean implements Sanitizer
{
    public function sanitize($value)
    {
        return boolvar($value);
    }
}
