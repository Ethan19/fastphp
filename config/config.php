<?php
//database config
define('DB_NAME','test');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_HOST','localhost');


//default controllers and default action
$config['defaultController']= 'Item';
$config['defaultAction']='index';


//DATABASE 
$config['db']['dbname'] = DB_NAME;
$config['db']['username'] = DB_USER;
$config['db']['password'] = DB_PASSWORD;
$config['db']['host'] = DB_HOST;
return $config;

