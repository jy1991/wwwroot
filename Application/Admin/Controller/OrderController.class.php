<?php
namespace Admin\Controller;
class OrderController extends AdminController {
    
    private $_user = null; 
	private $_order = null; 
    private $_order_pro = null;
   
	//初始化操作
	public function _initialize(){
		parent::_initialize();
		$this->_user = D('user');
		$this->_order = D('order');
		$this->_order_pro = D('order_pro');
    }

    public function index(){
    	$search=I('search','');
    	$where='';
    	if(!empty($search)){
    		$where=array('number'=>array('eq',$search));
    	}
    	$count=$this->_order->where($where)->count();
        $Page=new Page($count,10);
        $data=$this->_order->where($where)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
        $show=$Page->show();
        foreach ($data as $v) {
           $v['pro_info']=$this->_order_pro->where('order_number='.'"'.$v['number'].'"')->select();
           $all[]=$v;
        }
        
		$this->assign('page',$show);
        $this->assign('list',$all);
        $this->assign('search',$search);
        $this->display();
    }

}