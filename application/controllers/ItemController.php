<?php

class ItemController extends Controller{
    // public function __construct(){
    // }
    public function index(){
        $itemModel = new ItemModel();
        // echo '<pre>';
        // var_dump($itemModel);
        // echo '<pre>';
        // die;
       $res =  $itemModel->query("select * from item");
       $this->assign("list",$res);
       $this->render();
    }
}