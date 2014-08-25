<?php
namespace Pinpoint\Validator\Constraint;

use Pinpoint\Validator\Field;

abstract class AbstractContraint implements Constraint
{
    protected $params = array();
    protected $error = false;
    protected $message = false;

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        if ($this->error instanceof Error) {
            $this->error->setMessage($message);
        }
    }

    abstract public function validate(Field $field);

    public function error()
    {
        return $this->error;
    }
}
