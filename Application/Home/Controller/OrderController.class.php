<?php
namespace Home\Controller;

class OrderController extends HomeController {
   
   private $_user=null;
   private $_cart=null;
   private $_product=null;
   private $_pro_img=null;
   private $_order=null;
   private $_order_pro=null;
   private $_address=null;

   public function _initialize(){

      $this->_user=D('user');
      $this->_cart=D('cart');
      $this->_product=D('product');
      $this->_pro_img=D('pro_img');
      $this->_order=D('order');
      $this->_order_pro=D('order_pro');
      $this->_address=D('address');

      if(empty($_SESSION['home_user'])){
         $this->error('请先登录！',U('Public/login'));
         exit;
      }
   }

    public function add(){
      $select=explode(',',I('post.select'));
      $count=0;
      $i=0;
      $qty=0;
      $user_id=$_SESSION['home_user']['id'];
       $data=$this->_cart->where(array('user_id'=>$user_id))->order('addtime desc')->select();
       $order=array();  //生成订单
       $cart=array();   //购物车未进入订单
        foreach ($select as $value) {
         if($value=='true'){
                $count+=($data[$i]['num']*$data[$i]['price']);
                $qty+=$data[$i]['num'];
                $order[]=$data[$i];
                $i++;
         }else{
            $cart[]=$data[$i];
            $i++;
         }
        } 
         
         if($qty==0){
            $this->AjaxReturn('未选择商品','json');
            exit;
         }
  
         $_POST['user_id']=$_SESSION['home_user']['id'];
         $_POST['summary']=$count;
         $_POST['qty']=$qty;
         $_POST['addtime']=time();
         if(!$this->_order->create()){
            $this->AjaxReturn('订单表未create','json');
            exit;
         }
         $data_order['user_id']=$_SESSION['home_user']['id'];
         $data_order['summary']=$count;
         $data_order['qty']=$qty;
         $data_order['addtime']=time();
         $order_num=uniqid(rand(100));
         $data_order['number']=$order_num;
         
         if($this->_order->add($data_order)>0){
            
         }else{
            $this->AjaxReturn('订单表添加失败','json');
            exit;
         }

         $order_pro=array();
         foreach ($order as $pro) {
            $name =$this->_product->field('name')->find($pro['pro_id']);
            $pro['name']=$name['name'];
            $pro['qty']=$pro['num'];
            $pro['order_number']=$order_num;
            $order_pro[]=$pro;
         }
       
         if(!$this->_order_pro->create()){
            $this->AjaxReturn('订单商品表未create','json');
            exit;
         }

         foreach ($order_pro as $cart) {
            if($this->_order_pro->add($cart)>0){

            }else{
               $this->AjaxReturn('订单商品表添加失败','json');
               exit;
            }
         }

         foreach ($order_pro as $del) {
           $map=array();
           $map['user_id'] = array('eq',$_SESSION['home_user']['id']);
           $map['pro_id'] = array('eq',$del['pro_id']);
           $map['_logic'] = 'and';
           if($this->_cart->where($map)->delete()<=0){
              $this->AjaxReturn('购物车删除失败','json');
              exit;
           }
         }

      $select='';
      $count=0;
      $qty=0;
    }

   public function index(){
      $user_id=$_SESSION['home_user']['id'];
      $data = $this->_order->where('user_id='.$user_id)->select();
      $all=array();
      foreach ($data as $v) {
         $v['pro_info']=$this->_order_pro->where('order_number='.'"'.$v['number'].'"')->select();
         $all[]=$v;
      }

      $this->assign('list',$all);
      $this->display();
   }

   public function cancel(){
      $id=I('id');
      $data=array();
      $data['id']=$id;
      $data['display']=4;
      if(!$this->_order->create($data)){
         $this->error($this->_order->getError());
         exit;
      }
      if($this->_order->save()>0){
         $this->success('订单取消成功',U('index'));
      }else{
         $this->success('订单取消失败',U('index'));
      }

   }

   public function pay(){
      $user_id=$_SESSION['home_user']['id'];
      $map=array();
      $map['user_id'] = array('eq',$user_id);
      $map['is_default'] = array('eq',1);
      $map['_logic'] = 'and';      
      $address=$this->_address->where($map)->find();
      if(empty($address)){
          $this->error('请先设置默认地址',U('index'));
          exit;
      }
      $data['id']=I('id');
      $data['person']=$address['person'];
      $data['phone']=$address['phone'];
      $data['address']=$address['address'];
      $data['display']=1;
      if(!$this->_order->create($data)){
         $this->error($this->_order->getError());
         exit;
      }
      if($this->_order->save()>0){
         $this->success('订单支付成功',U('index'));
      }else{
         $this->success('订单地址添加失败',U('index'));
      }
   }

}