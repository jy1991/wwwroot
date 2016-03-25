<?php 
namespace Home\Model;
use \Think\Model;

class UserModel extends Model{
    protected $_validate = array(
    	array('yzm','require','验证码必须'),
    	array('email','','该邮箱已被注册',0,'unique'),
    	array('email','/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i','邮箱格式不正确'),
      array('pass','checkPwd','密码格式为5-16位数字字母下划线',0,'callback'),
    	array('pass','repass','确认密码不正确',0,'confirm'),

    );
    public function checkPwd($pass){
      if(!preg_match('/^[0-9a-zA-Z_]{5,16}$/',$pass)){
          return false;
      }else{
          return true;
      }
    }

    protected $_auto = array (
    	array('user','我的华为账号'), // 新增的时候把user字段设置为'我的华为账号'
      array('addtime','time',1,'function'), // 对addtime字段在添加的时候写入当前时间戳
      array('pass','auto_md5',3,'callback') , // 对pass字段在新增和编辑的时候使md5函数处理
      array('pass','',2,'ignore'), //pass字段编辑的时候留空则忽略
      array('grade',1,1), //grade字段添加时为1
	);

    public function auto_md5($pass){
      if($pass==''){
          return '';
      }else{
          return md5($pass);
      }
    }    
}



