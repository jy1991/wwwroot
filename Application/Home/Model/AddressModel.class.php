<?php 
namespace Home\Model;
use \Think\Model;

class AddressModel extends Model{
    protected $_validate = array(
    	array('person','require','姓名必须'),
    	array('phone','require','电话必须'),
    	array('address','require','地址必须'),
    	array('phone','/^[0-9]{11}$/','手机号码格式不正确'),
    );

    protected $_auto = array (

	);
   
}



