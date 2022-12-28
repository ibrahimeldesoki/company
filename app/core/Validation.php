<?php

namespace app\core;

class Validation
{
    private $errors = [];

    public function validateRequest(array $request, array $rules)
    {
        foreach ($rules as $ruleKey => $ruleValue) {
            if (in_array('required', $ruleValue)) {
                $this->validateRequiredInput($ruleKey, $request);
            }
            if (in_array('integer', $ruleValue) && array_key_exists($ruleKey,$request)) {
                $this->validateInteger($ruleKey, $request);
            }
            if (in_array('string', $ruleValue) && array_key_exists($ruleKey,$request)) {
                $this->validateString($ruleKey, $request);
            }
            if (in_array('bool', $ruleValue) && array_key_exists($ruleKey,$request)) {
                $this->validateBool($ruleKey, $request);
            }
        }

        return ['errors' => $this->errors];
    }

    private function validateRequiredInput(string $ruleKey, array $request)
    {
        if (!array_key_exists($ruleKey, $request)) {
             $this->errors[] = $ruleKey . ' required';
        }
    }

    private function validateInteger(string $ruleKey, array $request)
    {
        if (!filter_var($request[$ruleKey], FILTER_VALIDATE_INT))
        {
            $this->errors[]=  $ruleKey . ' must be integer';
        }
    }

    private function validateString(string $ruleKey, array $request)
    {
        if (!is_string($request[$ruleKey]))
        {
            $this->errors[]=  $ruleKey . ' must be string';
        }
    }

    private function validateBool(string $ruleKey, array $request)
    {
        $acceptable = [true, false, 0, 1, '0', '1'];

        if(!in_array($request[$ruleKey], $acceptable,true))
        {
            $this->errors[]=  $ruleKey . ' must be bool';
        }
    }
}