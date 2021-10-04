<?php

namespace Framework\Model\Classes;
use Framework\Interfaces\DatabaseConnectionInterface;
abstract class Model 

{
    protected DatabaseConnectionInterface $database;

    public function __construct()
    {
        $database_access_class = config('database', 'database_access_class');
        $this->database = $database_access_class::getInstance();
    }

}