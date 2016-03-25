<?php 
namespace Admin\Model;
use Think\Model;
class PlayerModel extends Model{
//自动验证
protected $_validate = array(
	array('player_id','/^[0-9]{1,3}$/','角色ID只能为1-3位数字'), //新增或修改时判断角色id格式
	array('player_id','','角色ID已经存在！',0,'unique'), // 验证角色id是否唯一
	array('player_name','require','角色名不能为空'), //新增或修改时判断player_name格式
	array('player_name','','角色名已经存在！',0,'unique'), // 在新增的时候验证角色名是否唯一
    );
}	