<?php
namespace Admin\Controller;
use \Think\Controller;
class PublicController extends Controller {
  //执行登录
  public function dologin() {
    $adminuser=I('post.adminuser');
    $adminpass=I('post.adminpass');
    $data=M('admin')->where(array('admin_user'=>$adminuser))->find();
    if(is_null($data)) {
       $this->error('用户名不存在！');
       exit;
    }
    if($data['admin_pass'] !== md5($adminpass)) {
       $this->error('密码错误！');
       exit;
    }
    if($data['status'] == 0) {
       $this->error('账号已被屏蔽！');
       exit;
    }
   //登录成功
   $_SESSION['admin_user']=$data;

   //根据用户id获取对应的节点信息
    //$sql = "select n.mname,n.aname from lamp_user u join lamp_user_role ur on u.id=ur.uid join lamp_role_node rn on ur.rid=rn.rid join lamp_node n on rn.nid=n.id where u.id={$users['id']}";
    //$list = M()->query($sql);
    $list = M('work')->field('controller_name,do_name')->where('id in'.M('player_work')->field('work_id')->where("player_id in ".M('admin_player')->field('player_id')->where(array('admin_id'=>array('eq',$data['id'])))->buildSql())->buildSql())->select();
    
    $worklist = array();
    $worklist['Index'] = array('index');
    //遍历重新拼装
    foreach($list as $v){
      $worklist[$v['controller_name']][] = $v['do_name'];
      //把修改和执行修改 添加和执行添加 拼装到一起
      if($v['do_name']=="edit"){
        $worklist[$v['controller_name']][]="update";
      }
      if($v['do_name']=="add"){
        $worklist[$v['controller_name']][]="insert";
      }
      if($v['do_name']=="edit_img"){
        $worklist[$v['controller_name']][]="update_img";
      }
      if($v['do_name']=="add_value"){
        $worklist[$v['controller_name']][]="insert_value";
      } 
      if($v['do_name']=="edit_value"){
        $worklist[$v['controller_name']][]="update_value";
      }           
    }

    //将权限信息放置到session中
    $_SESSION['admin_user']['worklist'] = $worklist;
    
   //成功跳转
   $this->redirect('Index/index','',1,'wait for login...');
  }

  public function loginout() {
     unset($_SESSION['admin_user']);
     $this->redirect('Index/index');
  }

  public function _empty($name){
      $this->myEmpty($name);
  }
  protected function myEmpty(){
      $this->display('Public/login');
  }

}  
