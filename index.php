<?php

// error_reporting();
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');


//开启调试模式
define("APP_DEBUG",false);



//重写__autoload
// spl_autoload_register(array("Fastphp","loadClass"));
spl_autoload_register(function($class){ 

    $class = str_replace("\\","/",$class);
    $file = $class.".php";

     $res = explode("/",$class);

    if(file_exists($file)){
        include $file;
    }elseif(extension_loaded($res[count($res)-1])){
            
    }else{
        exit("not found ".$file);

    }
});

//加载配置文件
$config = require(APP_PATH.'config/config.php');

//实例化
(new \Fastphp\Fastphp($config))->run();