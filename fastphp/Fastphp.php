<?php

class Fastphp{

    public function __construct($config){
        $this->_config = $config;
    }

    public static function run(){
        // spl_autoload_register(array(self,"loadClass"));
    }

    public static function loadClass($class){
        $framework = __DIR__.$class.".php";
    }
}