<?php

// error_reporting();
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');
define('APP_NAME',"Application");

//开启调试模式
define("APP_DEBUG",true);//是否开始php调试模式
define("SMARTY_DEBUG",true);//smarty是否开始调试模式
//加载composer
require_once APP_PATH."vendor/autoload.php";

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