<?php
namespace Admin\Controller;
class EmptyController extends AdminController {
	public function index(){
    	$this->display('Public/login');
    }
    public function _empty($name){
    	$this->myEmpty($name);
    }
    protected function myEmpty(){
    	$this->display('Public/login');
    }

}