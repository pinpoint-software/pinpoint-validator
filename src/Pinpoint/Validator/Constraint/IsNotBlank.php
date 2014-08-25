<?php
namespace Pinpoint\Validator\Constraint;

use Pinpoint\Validator\Field;

class IsNotBlank extends AbstractContraint
{
    public function validate(Field $field)
    {
        $value = $field->getValue();

        if (is_numeric($value)) {
            return true;
        } elseif (empty($value)) {
            $this->error = new Error($field->getLabel() . ' cannot be blank', $this->message);
            return false;
        }

        return true;
    }
}
