<?php
namespace Fastphp;
use Medoo\Medoo;
class Model extends Medoo{
    public static $dbConfig = [];

    public function __construct(){
        // 连接数据库 
        $server =array(
        		"database_type"=>self::$dbConfig['database_type'],
        		"database_name"=>self::$dbConfig['database_name'],
        		"server"=>self::$dbConfig['server'],
        		"username"=>self::$dbConfig['username'],
        		"password"=>self::$dbConfig['password']
        	); 
        			
        parent::__construct($server);
    }

}
