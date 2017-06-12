<?php
namespace Fastphp;
use Medoo\Medoo;
class Model extends Medoo{
    public static $dbConfig = [];

    public function __construct(){
        // 连接数据库 
        parent::__construct(array(self::$dbConfig['database_type'], self::$dbConfig['database_name'], self::$dbConfig['server'],
            self::$dbConfig['username'],self::$dbConfig['password']));
    }

}
