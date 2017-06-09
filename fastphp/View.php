<?php
namespace Fastphp;
class  View{

    protected $variables;
    protected $_controller;
    protected $_action;
    protected $smarty;
    public function __construct($controller,$action){
        $this->smarty = new \Smarty();
        $this->_controller = $controller;
        $this->_action = $action;
        //配置smarty
        // echo APP_PATH."Application/Views/";die;
        $this->smarty->setTemplateDir(APP_PATH."Application/Views/");
        $this->smarty->setCompileDir(APP_PATH."data/cache/templates_c/");
        $this->smarty->setConfigDir(APP_PATH."data/smarty_configs/");
        $this->smarty->setCacheDir(APP_PATH."data/cache/smarty_cache/");
        
        $this->smarty->caching = APP_DEBUG;
        $this->smarty->cache_lifetime = APP_DEBUG?120:0;

        $this->smarty->debugging = SMARTY_DEBUG; //smarty是否开启调试模式，TRUE,调试模式
        $this->smarty->debugging_ctrl = SMARTY_DEBUG?'URL':'NONE';
    }
    /**
     * 组合变量 function
     *
     * @param [type] $name
     * @param [type] $value
     * @return void
     */
    public function assign($name,$value){
        $this->smarty->assign($name,$value);
    }

    /**
     * Undocumented 重写smarty display方法
     *
     * @param string $template
     * @return void
     */
    public function display($template = ''){
        try{
            if($template){
                $template = $template.EXT;
                $this->smarty->display($template);
            }else{
                $controller = str_replace("Controller","",$this->_controller);
                $action = strtolower($this->_action);
                $template = $controller.'/'.$action.EXT;
                $this->smarty->display($template);
            }
        }catch(\Exception $e){
            exit("not found template  ".$template);
        }


    }
}