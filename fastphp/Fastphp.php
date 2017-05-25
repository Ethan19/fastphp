<?php

class Fastphp{

    public function __construct($config){
        $this->_config = $config;
    }

    public  function run(){
        $this->setReporting();
        $this->removeMagicQuotes();
        $this->unregisterGlobals();
        $this->setDbConfig();
        $this->route();
        // spl_autoload_register(array(self,"loadClass"));
    }
//路由
    public function route(){
        $controllerName = $this->_config['defaultController'];
        $actionName = $this->_config['defaultAction'];
        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url,'?');
        $url = $position ===  false?$url:substr($url,0,$position);
        $url = trim($url,"/");
        $param = array();
        if($url){
            // 使用“/”分割字符串，并保存在数组中
            $urlArray = explode('/', $url);
            // 删除空的数组元素
            $urlArray = array_filter($urlArray);
            // 获取控制器名
            $controllerName = ucfirst($urlArray[0]);
            
            // 获取动作名
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;
            // 获取URL参数
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
        }
        $controllerName  =$controllerName."Controller";
        try{
            if(!class_exists($controllerName)){
                // die($controllerName."NOT FOUND");
                throw new Exception($controllerName."NOT FOUND", 1);
            }
            if(!method_exists($controllerName,$actionName)){
                // die($controllerName."&nbsp;&nbsp; METHOD ".$actionName." NOT FOUND");
                throw new Exception($controllerName."&nbsp;&nbsp; METHOD ".$actionName." NOT FOUND", 1);
            }
        }catch(Exception $e){
            die($e->getMessage());
        }
        
        $dispatch = new $controllerName($controllerName,$actionName);

        call_user_func_array(array($dispatch,$actionName),$param);

    }

    public function setDbConfig(){
        if($this->_config['db']){
            Model::$dbConfig = $this->_config['db'];
        }
    }

    //验证是否开发magic_quotes_gpc，开启情况特殊参数会被"\"转移，使用stripSlashesDeep去掉斜杠，其实在新版中（5.4.O之后）这个作用已经消失
    //，在php.ini中设置magic_quotes_gpc，始终返回false，为了向下兼容，还是加入了这段代码，虽然没啥用
    public function removeMagicQuotes(){
        if(get_magic_quotes_gpc()){
            $_GET = isset($_GET) ? $this->stripSlashesDeep($_GET ) : '';
            $_POST = isset($_POST) ? $this->stripSlashesDeep($_POST ) : '';
            $_COOKIE = isset($_COOKIE) ? $this->stripSlashesDeep($_COOKIE) : '';
            $_SESSION = isset($_SESSION) ? $this->stripSlashesDeep($_SESSION) : '';
        }
    }

    private function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map(array($this, 'stripSlashesDeep'), $value) : stripslashes($value);
        return $value;
    }
    //register_globals不开启，万一开启了直接过滤掉，不过貌似新版本都开始不使用,本地环境5.6
    private function unregisterGlobals(){
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
    //检测开发环境，进行debug
    public  function setReporting(){
        if(APP_DEBUG == true){
            error_reporting(E_ALL);
            ini_set('display_errors','On');
        }else{
            error_reporting("0");
            ini_set('display_errors','Off');
            ini_set('log_errors', 'On');
        }
    }
    
    public static function loadClass($class){

        $framework = __DIR__."/".$class.".php";
        $controllers = APP_PATH.'application/controllers/'.$class.".php";
        $models = APP_PATH.'application/models/'.$class.".php";
        $fastphp  = APP_PATH.'fastphp/'.$class.'.php';

        try{
            if(file_exists($framework)){
                include $framework;
            }elseif(file_exists($controllers)){
                include $controllers;
            }elseif(file_exists($models)){
                include $models;
            }elseif(file_exists($fastphp)){
                include $fastphp;
            }else{
                throw new Exception("NOT FOUND file ".$class, 1);
            }
        }catch(Exception $e){
            die($e->getMessage());
        }


    }
}