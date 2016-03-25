<?php
namespace Home\Controller;
class PublicController extends HomeController {

  private $_user=null;

  public function _initialize(){
      $this->_user=D('user');
  }

  //执行登录
  public function dologin() {
    $code = I('post.yzm',''); 
      if($this->check_verify($code)){  
          $this->error("亲，验证码输错了哦！",U('login')); 
          exit; 
    }
    $email=I('post.email');
    $pass=I('post.pass');
    $data=$this->_user->where(array('email'=>$email))->find();
    if(is_null($data)) {
       $this->error('邮箱未注册！');
       exit;
    }
    if($data['pass'] !== md5($pass)) {
       $this->error('邮箱或密码错误！');
       exit;
    }
    if($data['display'] == 0) {
       $this->error('账号已被屏蔽！');
       exit;
    }
   //登录成功
   $_SESSION['home_user']=$data;

   //成功跳转
   $this->redirect('Index/index','',0,'');
  }

  public function loginout() {
     unset($_SESSION['home_user']);
     $this->redirect('Index/index');
  }

  public function _empty($name){
      $this->myEmpty($name);
  }
  protected function myEmpty(){
      $this->display('Index/index');
  }

  public function login(){
    $this->display();
  }

  Public function verify(){
      $config = array(
       'fontSize' => 24, // 验证码字体大小
       'length' => 4, // 验证码位数
       'useImgBg' => true, // 开启背景图
       'imageW' => '156',
       'imageH' => '60',
    );
    $Verify = new \Think\Verify($config);
    $Verify->entry();
  }

  public function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
  }

  public function cf_yzm(){
      $code2 = I('yzm','');  
      if(!$this->check_verify($code2)){  
         $this->AjaxReturn('0','json');
      }else{
         $this->AjaxReturn('1','json');
      }
  }
  
  //注册页面
  public function add(){
      $this->display();
      
  }

  //注册处理
  public function register(){
      $code = I('post.yzm',''); 
      if($this->check_verify($code)){  
          $this->error("亲，验证码输错了哦！",U('add')); 
          exit; 
      }
      if(!$this->_user->create()){
          exit($this->_user->getError());
      }
      if($this->_user->add()>0){
          $this->success('注册成功！',U('Index/index'));
      }else{
          $this->error('注册失败');
      }
  }

}  
