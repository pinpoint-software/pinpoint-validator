<?php
namespace Pinpoint\Validator\Sanitizer;

class String implements Sanitizer
{
    public function sanitize($value)
    {
        return trim(preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $value));
    }
}
