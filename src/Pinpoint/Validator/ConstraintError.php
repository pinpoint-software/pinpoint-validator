<?php
namespace Pinpoint\Validator;

class ConstraintError
{
    protected $error;
    protected $message = false;

    public function __construct($error)
    {
        $this->error = $error;
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
}
