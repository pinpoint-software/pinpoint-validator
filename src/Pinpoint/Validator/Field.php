<?php
namespace Pinpoint\Validator;

use Pinpoint\Validator\Sanitizer\Sanitizer;

class Field
{
    protected $label;
    protected $value;

    public function __construct($label, $value)
    {
        $this->setLabel($label);
        $this->setValue($value);
    }

    public function getLabel()
    {
        return $this->label;
    }

    protected function setLabel($label)
    {
        $this->label = $label;
    }

    public function getValue()
    {
        return $this->value;
    }

    protected function setValue($value)
    {
        $this->value = $value;
    }

    public function sanitize(Sanitizer $sanitizer)
    {
        $this->value = $sanitizer->sanitize($this->value);
    }
}
