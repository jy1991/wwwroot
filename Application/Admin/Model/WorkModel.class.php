<?php 
	namespace Admin\Model;
	use Think\Model;
	class WorkModel extends Model{
		//自动验证
		protected $_validate = array(
		  array('id','require','ID不能为空'), 
		  array('work_name','require','权限名不能为空'), 
		  array('controller_name','require','控制器名不能为空'), 
		  array('do_name','require','操作名不能为空'),
		);
	}