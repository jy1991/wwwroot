<?php
namespace Home\Controller;

class UserController extends HomeController {
   
   private $_user=null;
   private $_cart=null;

   public function _initialize(){

      $this->_user=D('user');
      $this->_cart=D('cart');
      if(empty($_SESSION['home_user'])){
         $this->error('请先登录！',U('Public/login'));
         exit;
      }
	
  }
 
    public function index(){
      $data = $this->_user->find($_SESSION['home_user']['id']);
      $avatar=D('avatar')->where('user_id='.$_SESSION['home_user']['id'])->select();
      if(empty($avatar)){
         $avatar=null;
         $avatar['largeavatar']='avatar_default.jpg';
         $this->assign('avatar',$avatar);
      }else if($avatar[0]['display']=='0'){
         $avatar=null;
         $avatar['largeavatar']='avatar_wait.jpg';
         $this->assign('avatar',$avatar);
      }else if($avatar[0]['display']=='2'){
         $avatar=null;
         $avatar['largeavatar']='avatar_no_pass.jpg';
         $this->assign('avatar',$avatar); 
      }else{
         $this->assign('avatar',$avatar[0]);
      }
      $this->assign('item',$data);
      
      $this->display();
    }

    public function update() {
      if(I('post.pass')==''){
         unset($_POST['pass']);
         unset($_POST['repass']);
      }

      if(!$this->_user->create()){
          exit($this->_user->getError());
      }
          
      if($this->_user->save()>0) {
          unset($_SESSION['home_user']);
          $_SESSION['home_user']=$this->_user->find(I('post.id'));
          $this->success('用户修改成功！',U('Index/index'));
      }else {
          $this->error('用户修改失败！',U('index'));
      }
    }

}