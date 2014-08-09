<?php
namespace Pinpoint\Validator\Sanitizer;

class Callback implements Sanitizer
{
    public function __construct($params)
    {
        if (isset($params[0])) {
            $this->callback = $params[0];
        } else {
            $this->callback = false;
        }
    }

    public function sanitize($value)
    {
        if (is_callable($this->callback)) {
            return call_user_func($this->callback, $value);
        } else {
            return null;
        }
    }
}
