<?php
namespace Application\Controller;
use Fastphp\Controller as Controller;
use Application\Model\ItemModel as ItemModel;
class IndexController extends Controller{


    /**
     * Undocumented function
     *
     * @return void
     * @param
     * @return
     * @throw
     * @date date() 
     */
    public function index(){

        $itemModel = new ItemModel();
        $res =  $itemModel->getData();
                    
        // $this->assign("list",$res);
        $this->display();
    }
}