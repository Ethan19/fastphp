<?php

class  View{

    protected $variables;
    protected $_controller;
    protected $_action;
    public function __construct($controller,$action){
        $this->_controller = $controller;
        $this->_action = $action;
    }
    /**
     * 组合变量 function
     *
     * @param [type] $name
     * @param [type] $value
     * @return void
     */
    public function assign($name,$value){
        $this->variables[$name] = $value;
    }

    /**
     * 渲染变量 function
     *
     * @return void
     */
    public function render(){
        extract($this->variables);
        $controller = str_replace("Controller","",$this->_controller);
        $defaulHeader = APP_PATH.'application/views/header.php';
        $defaulFooter = APP_PATH.'application/views/footer.php';

        $controllerHeader = APP_PATH.'application/views/'.$controller.'/header.php';
        $controllerFooter = APP_PATH.'application/views/'.$controller.'/footer.php';
        $controllerLayout = APP_PATH.'application/views/'.$controller.'/'.$this->_action.'.php';
        if(file_exists($controllerHeader)){
            include $controllerHeader;
        }else{
            include $defaulHeader;
        }
        include $controllerLayout;

        if(file_exists($controllerFooter)){
            include $controllerFooter;
        }else{
            include $defaulFooter;
        }



    }
}