<?php 
namespace Home\Model;
use \Think\Model;

class CartModel extends Model{
    protected $_validate = array(
    );

    protected $_auto = array (
      array('addtime','time',1,'function'), // 对addtime字段在添加的时候写入当前时间戳
	);
}



