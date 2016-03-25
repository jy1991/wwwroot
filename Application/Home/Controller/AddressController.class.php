<?php
namespace Home\Controller;

class AddressController extends HomeController {
   
   private $_user=null;
   private $_address=null;

   public function _initialize(){
      $this->_user=D('user');
      $this->_address=D('address');
      if(empty($_SESSION['home_user'])){
         $this->error('请先登录！',U('Public/login'));
         exit;
      }

	}

   public function index(){
   	  $user_id=$_SESSION['home_user']['id'];
   	  $data=$this->_address->where('user_id='.$user_id)->select();
   	  $this->assign('list',$data);
   	  $this->display();
   } 

   public function add(){
      $user_id=$_SESSION['home_user']['id'];
   	  $_POST['user_id']=$user_id;
   	  if($_POST['is_default']==1){
	   	  $all=$this->_address->where('user_id='.$user_id)->select();
	   	  foreach ($all as $value) {
	   	  	  $item=array();
	   	  	  $item['id']=$value['id'];
	   	  	  $item['is_default']=0;
	   	  	  if($value['is_default']==1){
	   	  	  	 if(!$this->_address->create($item)){
	               exit($this->_address->getError());
	             }
	             if($this->_address->save()<=0){
	          	    $this->error('原默认地址修改失败',U('index')); 
	             exit;
	             }  
	   	  	  }
	   	  }
   	  }
   	  
   	  if(!$this->_address->create()){
          exit($this->_address->getError());
      }
      if($this->_address->add()>0){
          $this->success('收货地址添加成功',U('index'));
      }else{
      	  $this->error('收货地址添加失败',U('index')); 
      }
   }

   public function set_default(){
   	  $user_id=$_SESSION['home_user']['id'];
   	  $data=array();
   	  $data['id']=I('id/d');
   	  $data['user_id']=$user_id;
   	  $data['is_default']=1;
   	  $all=$this->_address->where('user_id='.$user_id)->select();
   	  foreach ($all as $value) {
   	  	  $item=array();
   	  	  $item['id']=$value['id'];
   	  	  $item['is_default']=0;
   	  	  if($value['is_default']==1){
   	  	  	 if(!$this->_address->create($item)){
               exit($this->_address->getError());
             }
             if($this->_address->save()<=0){
          	    $this->error('原默认地址修改失败',U('index')); 
             exit;
             }  
   	  	  }
   	  }
   	  if(!$this->_address->create($data)){
          exit($this->_address->getError());
      }
      if($this->_address->save()>0){
          $this->success('默认地址修改成功',U('index'));
      }else{
      	  $this->error('默认地址修改失败',U('index')); 
      }   	  
   }

   public function delete(){
   	  $id=I('id/d');
   	  if($this->_address->delete($id)>0){
   	  	 $this->success('地址删除成功',U('index'));
   	  }else{
   	  	 $this->error('地址修改失败',U('index'));
   	  }

   }

}