<?php
namespace Pinpoint\Validator;

use Exception;
use Pinpoint\Validator\Constraint\Error;

class Validator
{
    protected $fields = array();
    protected $sanitizers = array();
    protected $constraints = array();
    protected $errors = array();

    public function field($key, $label, $value)
    {
        $this->fields[$key] = new Field($label, $value);
        unset($this->errors[$key]);
        $this->resanitize($key);
        $this->recheckConstraints($key);
    }

    public function sanitize($key, $sanitizer)
    {
        $params = array_slice(func_get_args(), 2);
        $sanitizer = SanitizerFactory::create($sanitizer, $params);
        $this->fields[$key]->sanitize($sanitizer);
        if (!isset($this->sanitizers[$key])) {
            $this->sanitizers[$key] = array();
        }
        $this->sanitizers[$key][] = $sanitizer;
    }

    public function checkIf($key, $constraint)
    {
        $params = array_slice(func_get_args(), 2);
        $constraint = ConstraintFactory::create($constraint, $params);
        if (!isset($this->fields[$key])) {
            throw new Exception('Missing field ' . $key);
        } elseif (false === $constraint->validate($this->fields[$key], $params)) {
            if (!isset($this->errors[$key])) {
                $this->errors[$key] = array();
            }
            $this->errors[$key][] = $constraint->error();
        }
        if (!isset($this->constraints[$key])) {
            $this->constraints[$key] = array();
        }
        $this->constraints[$key][] = $constraint;
        return $constraint;
    }

    public function checkForm($callback)
    {
        $params = array_slice(func_get_args(), 1);
        if (is_callable($callback)) {
            return call_user_func($callback, $this->fields, $params);
        } else {
            throw new Exception('checkForm expects a callback');
        }
    }

    public function isValid()
    {
        return empty($this->errors);
    }

    public function getValues()
    {
        $values = array();
        foreach ($this->fields as $key => $field) {
            $values[$key] = $field->getValue();
        }
        return $values;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($key, $error)
    {
        if (!isset($this->errors[$key])) {
            $this->errors[$key] = array();
        }

        if (is_string($error)) {
            $error = new Error($error);
        }

        if ($error instanceof Error) {
            $this->errors[$key][] = $error;
        } else {
            throw new Exception('Invalid error value');
        }
    }

    protected function resanitize($key)
    {
        if (isset($this->sanitizers[$key]) && is_array($this->sanitizers[$key])) {
            foreach (array_keys($this->sanitizers[$key]) as $s) {
                $this->fields[$key]->sanitize($this->sanitizers[$key][$s]);
            }
        }
    }

    protected function recheckConstraints($key)
    {
        if (isset($this->constraints[$key]) && is_array($this->constraints[$key])) {
            foreach (array_keys($this->constraints[$key]) as $c) {
                if (false === $this->constraints[$key][$c]->validate($this->fields[$key])) {
                    $this->addError($key, $this->constraints[$key][$c]->error());
                }
            }
        }
    }
}
