<?php

/**
 * Contains a simple data validator for form validation
 */

 namespace Framework\Classes;

use Exception;
use InvalidArgumentException;

class Validator
 {
     protected array $rules;
     protected static $rulesList;
     public function __construct(array $rules)
     {
         $this->rules = $rules;
     }
     public static function getInstance($rules) {
        return new Validator($rules);
     }
     public function validateRequest(Request $request) {
         foreach($this->rules as $field=>$rules)
            foreach($rules as $rule){
                if (str_contains($rule, ':'))
                {
                    $rule_array = explode(':', $rule);
                    $key = $rule_array[0].":x";
                    $argument = $rule_array[1];
                    $validatorFromConfig = config('validator', $key);
                    if(!is_callable($validatorFromConfig['rule']))
                        throw new InvalidArgumentException("Validator ".$key." in config is not a callable function");
                    if(!$validatorFromConfig['rule']($request, $field, $argument))
                        Session::append('errors', $field." ".str_replace('*', $argument, $validatorFromConfig['message']));
                }
                else {
                    $validatorFromConfig = config('validator', $rule);
                    if(!is_callable($validatorFromConfig['rule']))
                        throw new InvalidArgumentException("Validator ".$rule." in config is not a callable function");
                    if(!$validatorFromConfig['rule']($request, $field))
                        Session::append('errors', $field." ".$validatorFromConfig['message']);
                }
            }
         if(Session::hasKey('errors')){
            foreach(array_keys($this->rules) as $field)
            {
                Session::append('old', $request->getKey($field), $field);
            }
            Redirect::redirectWithErrors(422);
         }
         else{
             Session::clearKey('old');
         }
     }
 }