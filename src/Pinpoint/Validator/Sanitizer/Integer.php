<?php
namespace Pinpoint\Validator\Sanitizer;

class Integer implements Sanitizer
{
    public function sanitize($value)
    {
        return intval($value);
    }
}
