<?php
namespace Pinpoint\Validator\Constraint;

use Pinpoint\Validator\Field;

class InArray extends AbstractContraint
{
    public function validate(Field $field)
    {
        $success = true;
        $value = $field->getValue();

        if (isset($this->params[0]) && is_array($this->params[0])) {
            $validValues = $this->params[0];
        } else {
            $success = false;
        }

        if (true === $success) {
            $success = (false !== array_search($value, $validValues));
        }

        if (false === $success) {
            $this->error = new Error($field->getLabel() . ' is not in array', $this->message);
        }

        return $success;
    }
}
