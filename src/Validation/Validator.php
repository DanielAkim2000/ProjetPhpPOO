<?php

namespace App\Validation;

class Validator{

    private $data;
    private $errors;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    private function getErrors() : ?array
    {
        return $this->errors;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $name => $rulesArray){
            if(array_key_exists($name, $this->data)) {
                foreach($rulesArray as $rule) {
                    switch ($rule) {
                        //Pour les differents exigence de mon validator
                        case 'required':
                            $this->required($name, $this->data[$name]);
                            break;
                        case substr($rule, 0, 3) === 'min' :
                            $this->min($name ,$this->data[$name], $rule);
                            break;
                        case substr($rule, 0, 3) === 'max' :
                            $this->max($name ,$this->data[$name], $rule);
                        default:
                            break;
                    }
                }
            }
        }
        return $this->getErrors();
    }

    public function required(string $name , string $value)
    {
        $value = trim($value);

        if(!isset($value) || is_null($value) || empty($value)) {
            $this->errors[$name][] = "{$name} est requis.";
        }
    }

    public function min(string $name, string $value, string $rule)
    {
        // '/(\d+)' permet de recuperer tous les caracteres numerique
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if(strlen($value) < $limit) {
            $this->errors[$name][] = "{$name} est doit comprendre un minimum de {$limit} caractères .";
        }

    }

    public function max(string $name, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);
        $limit = (int) $matches[0][0];

        if(strlen($value) > $limit) {
            $this->errors[$name][] = "{$name} est doit comprendre un maximum de {$limit} caractères .";
        }

    }
}
