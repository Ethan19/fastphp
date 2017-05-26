<?php
namespace Application\Controller;
use Fastphp\Controller as Controller;
use Application\Model\ItemModel as ItemModel;
class ItemController extends Controller{
    // public function __construct(){
    // }
    public function index(){
        $itemModel = new ItemModel();
        $res =  $itemModel->query("select * from item");
        $this->assign("list",$res);
        $this->render();
    }
}