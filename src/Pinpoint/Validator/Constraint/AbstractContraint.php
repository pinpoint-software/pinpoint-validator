<?php
namespace Pinpoint\Validator\Constraint;

use Pinpoint\Validator\Field;

abstract class AbstractContraint implements Constraint
{
    protected $params = array();
    protected $message = false;
    protected $error = false;

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    abstract public function validate(Field $field);

    public function error()
    {
        if (false === $this->message) {
            return $this->error;
        } else {
            return $this->message;
        }
    }
}
