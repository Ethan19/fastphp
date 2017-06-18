<?php
namespace Application\Controller;
use Fastphp\Controller as Controller;
use Application\Model\ItemModel as ItemModel;
class IndexController extends Controller{


    /**
     * description
     * @Author Ethan
     * @date   2017-06-14T17:10:21+0800
     * @return [type]
     */
    public function index(){

        // $itemModel = new ItemModel();
                    
        // $res =  $itemModel->select("item",['email']);
        // $this->assign("list",$res); 
        $this->display();
    }
}