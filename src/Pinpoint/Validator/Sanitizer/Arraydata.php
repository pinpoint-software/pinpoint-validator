<?php
namespace Pinpoint\Validator\Sanitizer;

class Arraydata implements Sanitizer
{
    public function sanitize($value)
    {
        return is_array($value) ? $value : [$value];
    }
}
