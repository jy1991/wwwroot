<?php
namespace Home\Controller;

class IndexController extends HomeController {
    public function index(){
    	//实例化
        $category = D('List');
		//获取分类信息
		$list = $category->getHomeCate();
		$pro_num=D('pro_num')->select();

		$all=array();
        $data=array(); 
        foreach ($list as $l) {
        	foreach ($pro_num as $p) {
        		
				$list_id=$p['list_id'];
				$pid=D('List')->where('id='.$list_id)->field('pid')->find();
				if($pid['pid']==$l['id']){
				   $product=D('product')->where('number='.$p['pro_num'])->select();
				   $img=D('pro_img')->where(array('pro_id'=>$product[0]['id'],'is_face'=>1))->select();
				   $product[0]['img']='Uploads/'.$img[0]['path'].$img[0]['name'];	
                   $data[0]=$product[0];
                }
			}
		    $l['pro']=$data;
		    $all[]=$l;
		    $data=null;
		} 
        
        $this->assign('list',$all);
        
        $this->display();
    }
}