<?php
namespace Home\Controller;

class ProductController extends HomeController {
    public function index(){
    	$num=I('num');
    	$pro_no=I('pro_no',0);  //单个商品下标
        $pro_num=D('pro_num')->where('pro_num='.$num)->select();
        
        //所有商品信息和图片
        $pro=array();
        $item_pro=array();
        foreach ($pro_num  as $n) {
        	$item_pro=D('product')->find($n['pro_id']);
        	$item_pro['img']=D('pro_img')->where('pro_id='.$n['pro_id'])->select();
        	$pro[]=$item_pro;
        	$item_pro=null;
        }

        //当前商品id
        $pro_id=$pro[$pro_no]['id'];

        //商品id列表
        $pro_list=array();
        foreach ($pro as $p) {
        	$pro_list[]=$p['id'];
        }
        //所有该商品对应的属性和值
        $attr_list=array();
        $attr=D('pro_attr')->select();
        foreach ($attr as $a) {
        	if(in_array($a['pro_id'], $pro_list)){
                $attr_list[]=$a;
            }
        }
        //属性id和属性值
        $list=array();
        foreach ($attr_list as  $al) {
        	$list[$al['attr_id']].=$al['value_id'].',';
        }
        
        //拼接属性
        $all_attr=array();  
        foreach ($list as $key => $li) {
         	$all_attr[$key]=D('attribute')->find($key);
            $all_attr[$key]['value']=D($all_attr[$key]['title'])->select();
         } 
        
        //本商品属性
        $item_attr=array();
        $title="'";
        foreach ($all_attr as $attr) {
            $title.=$attr[title]."','";
        }
        $title=rtrim(rtrim($title,"'"),',');
       
        $this->assign('pro',$pro[$pro_no]); //单个商品信息
        $this->assign('attr',$all_attr);  //所有属性信息
        $this->assign('title',$title);  //所有属性表名
        $this->assign('pro_id',$pro_id);  //当前商品id
        $this->display();
    }

    public function attr(){
        $num=I('post.num');

        $pro_num=D('pro_num')->where('pro_num='.$num)->select();
        
        //所有商品信息和图片
        $pro=array();
        $item_pro=array();
        foreach ($pro_num  as $n) {
            $item_pro=D('product')->find($n['pro_id']);
            $item_pro['img']=D('pro_img')->where('pro_id='.$n['pro_id'])->select();
            $pro[]=$item_pro;
            $item_pro=null;
        }

        //当前商品id
        $pro_id=$pro[$pro_no]['id'];

        //商品id列表
        $pro_list=array();
        foreach ($pro as $p) {
            $pro_list[]=$p['id'];
        }
        //所有该商品对应的属性和值
        $attr_list=array();
        $attr=D('pro_attr')->select();
        foreach ($attr as $a) {
            if(in_array($a['pro_id'], $pro_list)){
                $attr_list[]=$a;
            }
        }
        //属性id和属性值
        $list=array();
        foreach ($attr_list as  $al) {
            $list[$al['attr_id']].=$al['value_id'].',';
        }
        
        //拼接属性
        $all_attr=array();  
        foreach ($list as $key => $li) {
            $all_attr[$key]=D('attribute')->find($key);
            $all_attr[$key]['value']=D($all_attr[$key]['title'])->select();
         }

        //本商品属性
        $title=array();
        foreach ($all_attr as $attr) {
            $title[]=$attr['title'];
        }
        
        //select
        $select=array();
        foreach ($title as $key => $value) {
           $attr_id=D('attribute')->where('title='.$value)->field('id')->select();  
        }
        

        $this->ajaxReturn($title,'json');
    }
}