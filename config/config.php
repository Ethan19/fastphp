<?php
//database config
define('DATABASE_TYPE','mysql');
define('DATABASE_NAME','fastphp');
define('SERVER','127.0.0.1');
define('USERNAME','root');
define('PASSWORD','root');

//smarty 模板后缀名，默认为html，也可以改为tpl
define('EXT','.html');

//default controllers and default action
$config['defaultController']= 'Index';
$config['defaultAction']='Index';


//DATABASE 
$config['db']['database_type'] = DATABASE_TYPE;
$config['db']['database_name'] = DATABASE_NAME;
$config['db']['server'] = SERVER;
$config['db']['username'] = USERNAME;
$config['db']['password'] = PASSWORD;
return $config;

