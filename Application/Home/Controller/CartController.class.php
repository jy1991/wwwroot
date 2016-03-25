<?php
namespace Home\Controller;

class CartController extends HomeController {
   
   private $_user=null;
   private $_cart=null;
   private $_pro_attr=null;
   private $_attribute=null;
   private $_product=null;
   private $_pro_img=null;

   public function _initialize(){

      $this->_user=D('user');
      $this->_cart=D('cart');
      $this->_pro_attr=D('pro_attr');
      $this->_attribute=D('attribute');
      $this->_product=D('product');
      $this->_pro_img=D('pro_img');

      if(empty($_SESSION['home_user'])){
         $this->error('请先登录！',U('Public/login'));
         exit;
      }
	
  }
 
    public function index(){
        $user_id=$_SESSION['home_user']['id'];
      
        $count=$this->_cart->where(array('user_id'=>$user_id))->count();
        $Page=new Page($count,5);
        $data=$this->_cart->where(array('user_id'=>$user_id))->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
        $show=$Page->show();
        $this->assign('page',$show);

        $arr = array(); //声明一个空数组
        //遍历属性信息
        foreach($data as $v){
            $role_ids = $this->_pro_attr->field('attr_id,value_id')->where(array('pro_id'=>array('eq',$v['pro_id'])))->select();
            //定义空数组
            $roles = array();
            //遍历
            foreach($role_ids as $value){
                $rol = $this->_attribute->where(array('id'=>array('eq',$value['attr_id'])))->getField('title');
                $name = $this->_attribute->where(array('id'=>array('eq',$value['attr_id'])))->getField('name');
                $title=D($rol)->field('value')->where('id='.$value['value_id'])->find();
                $roles[]=$name." : ".$title['value']; 
            }
            $v['role'] = $roles; //将新得到属性信息放置到$v中
            $arr[] = $v;
        }

        $pro = array();
        //遍历商品信息
        foreach ($arr as $item) {
         	$pro_item = $this->_product->field('name,price,ad')->find($item['pro_id']);
         	$item['pro_info']=$pro_item;
            $pro[]=$item;
        }

        $all = array();
        //遍历图片信息
        foreach ($pro as $p) {
        	$map['pro_id'] = array('eq',$p['pro_id']);
		      $map['is_face'] = array('eq','1');
		      $map['_logic'] = 'and';
         	$img = $this->_pro_img->field('name,path')->where($map)->limit(1)->select();
         	$p['img']=$img[0];
         	$all[]=$p;
        } 

      $this->assign('list',$all);
      $this->display();
    }

    public function update() {

    }

    public function add(){
      $num=I('post.num');
      $pro_id=I('post.pro_id');
      $cf_num=D('product')->field('stock')->find($pro_id);
      if($num > $cf_num['stock']){
      	 $this->error('购买商品数超过库存！');
      	 exit;
      }	
      $_POST['user_id']=$_SESSION['home_user']['id'];
      if(!$this->_cart->create()){
        exit($this->_cart->getError());
      }
      if($this->_cart->add()>0) {
          $this->success('购物车添加成功！',U('index'));
      }else {
          $this->error('购物车添加失败！');
      }
    }

    public function delete(){
    	if($this->_cart->delete(I('id'))>0){
    		$this->success('购物车删除成功！',U('index'));
    	}else{
    		$this->error('购物车删除失败！');
    	}
    }

    public function count(){
    	$select=explode(',',I('post.select'));
    	$count=0;
    	$i=0;
    	$user_id=$_SESSION['home_user']['id'];
	    $data=$this->_cart->where(array('user_id'=>$user_id))->order('addtime desc')->select();
      foreach ($select as $value) {
    		if($value=='true'){
	    		    $count+=($data[$i]['num']*$data[$i]['price']);
	            $i++;
        }else{
    			$i++;
    		}
    	}
      
    	$this->AjaxReturn($count,'json');
    	$select='';
    	$count=0;
    }

}