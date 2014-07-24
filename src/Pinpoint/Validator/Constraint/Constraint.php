<?php
namespace Pinpoint\Validator\Constraint;

use Pinpoint\Validator\Field;

interface Constraint
{
    public function setParams(array $params);
    public function setMessage($message);
    public function validate(Field $field);
    public function error();
}
