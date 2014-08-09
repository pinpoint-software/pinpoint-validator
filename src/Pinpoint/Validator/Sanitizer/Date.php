<?php
namespace Pinpoint\Validator\Sanitizer;

class Date implements Sanitizer
{
    public function __construct($params)
    {
        if (isset($params[0])) {
            $this->format = $params[0];
        } else {
            $this->format = 'Y-m-d';
        }
    }

    public function sanitize($value)
    {
        return date($this->format, strtotime($value));
    }
}
