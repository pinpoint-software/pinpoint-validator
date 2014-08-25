<?php
namespace Pinpoint\Validator\Constraint;

use JsonSerializable;

class Error implements JsonSerializable
{
    protected $error;
    protected $message = false;

    public function __construct($error, $message)
    {
        $this->error = $error;
        $this->message = $message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function __toString()
    {
        if (false === $this->message) {
            return $this->error;
        } else {
            return $this->message;
        }
    }

    public function jsonSerialize()
    {
        return $this->__toString();
    }
}
