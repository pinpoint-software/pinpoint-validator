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
        if (is_string($value)) {
            $ts = strtotime($value);
        } else {
            $ts = 0;
        }
        if (0 == $ts) {
            return null;
        } else {
            return date($this->format, $ts);
        }
    }
}
