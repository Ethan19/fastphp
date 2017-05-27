<?php
namespace Fastphp;
class Controller{
    protected $_controller;
    protected $_action;
    protected $_view;

    public function __construct($_controller,$_action){
        $this->_controller  = $_controller;
        $this->_action = $_action;
        $this->_view = new View($_controller,$_action);
    }

    public function assign($name,$value){
        $this->_view->assign($name,$value);
    }

    public function render(){
        $this->_view->render();
    }

    public function display($template = ''){
        $this->_view->display($template);
    }
}