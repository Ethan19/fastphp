<?php

// error_reporting();
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');


//开启调试模式
define("APP_DEBUG",true);

//加载框架文件
//require APP_PATH.'fastphp/Fastphp.php';

//重写__autoload
// spl_autoload_register(array("Fastphp","loadClass"));
spl_autoload_register(function($class){ 
    // echo $class;
    // echo "<br />";
    $class = str_replace("\\","/",$class);
    $file = $class.".php";
    // $file = $class;
     
    if(file_exists($file)){
        echo $file."<br />";
        include $file;
    }else{
        exit("not found ".$file);
    }
});

//加载配置文件
$config = require(APP_PATH.'config/config.php');

//实例化
(new \Fastphp\Fastphp($config))->run();