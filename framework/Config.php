<?php

namespace Framework;

use Framework\Traits\ConfigAccess;

/** Handles reading all configuration options for the app */

class Config
{
    use ConfigAccess;
    protected $config;
    public function __construct(string $configname)
    {
        $this->config = $this->getConfigArray($configname);
    }

    /** 
     * Checks if the given key exists in the config
     * 
     * @param string $key
     * @return bool
     */
    public function hasKey(string $key) :bool
    {
        return array_key_exists($key, $this->config);
    }

    /**
     * Returns the value for the given configuration key if it exists
     * 
     * @param string $key
     * @return mixed
     */
    public function getKey(string $key) :mixed
    {
        if($this->hasKey($key))
            return $this->config[$key];
        else return false;
    }

    public function getAll()  :array
    {
        return $this->config;
    }
}