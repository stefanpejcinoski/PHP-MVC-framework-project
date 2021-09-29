<?php

namespace Framework;

/**
 * Defines a request object and methods to retrieve the request's parameters
 */
class Request 
{
    protected $request;
    protected $accepts;
    protected $method;
    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->accepts = explode(',', $_SERVER['HTTP_ACCEPT']);
    }

    public function hasKey(string $key) :bool 
    {
        return array_key_exists($key, $this->request);
    }

    public function getKey(string $key) :mixed
    {
        if ($this->hasKey($key))
            return $this->request[$key];
        return false;
    }

    public function method() :string
    {
        return $this->method;
    }

    public function acceptsJson() :bool 
    {
        return in_array('application/json', $this->accepts) || in_array('*/*', $this->accepts);
    }

    public function only(array $parameters) :array
    {
        $returnArray = [];
        foreach ($parameters as $param) {
            array_push($returnArray, $this->getKey($param));
        }
        return $returnArray;
    }
    
    public function accepts() :array
    {
        return $this->accepts;
    }
    
}