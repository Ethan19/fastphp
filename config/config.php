<?php
//database config
define('DB_NAME','fastphp');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');

//smarty 模板后缀名，默认为html，也可以改为tpl
define('EXT','.html');

//default controllers and default action
$config['defaultController']= 'Index';
$config['defaultAction']='Index';


//DATABASE 
$config['db']['dbname'] = DB_NAME;
$config['db']['username'] = DB_USER;
$config['db']['password'] = DB_PASSWORD;
$config['db']['host'] = DB_HOST;
return $config;

