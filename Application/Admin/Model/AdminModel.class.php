<?php 
namespace Admin\Model;
use \Think\Model;

class AdminModel extends Model{
    protected $_validate = array(
    	array('admin_user','','用户名已存在',0,'unique'),
    	array('admin_user','/^[0-9a-zA-Z_]{5,8}$/','用户名格式不正确'),
    	array('admin_pass','checkPwd','密码格式不正确',0,'callback'),
    );
    public function checkPwd($admin_pass){
      if(!preg_match('/^[0-9a-zA-Z_]{5,16}$/',$admin_pass)){
          return false;
      }else{
          return true;
      }
    }
}



