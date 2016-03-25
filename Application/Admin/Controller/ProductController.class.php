<?php
namespace Admin\Controller;
class ProductController extends AdminController {

    private $_product = null; //商品库操作类
    private $_attribute = null; //属性表操作类
    private $_pro_attr = null; //商品——属性表操作类
    private $_map = null; //搜索商品名和分类 总条件
    private $_pro_img=null; //商品图片表操作类
    private $_pro_num=null;
    
    //初始化操作
    public function _initialize(){
        parent::_initialize();
        $this->_product = D('product');
        $this->_attribute = D('attribute');
        $this->_pro_attr = D('pro_attr');
        $this->_pro_img=D('pro_img');
        $this->_pro_num=D('pro_num');
    }

    public function index(){
        $category = D('List');
        //获取分类信息
        $cate = $category->getHomeCate();
        $this->assign('cate',$cate);

    	$list_id=I('list_id/d',0);
    	if($list_id!=0){
    		$this->assign('list_id',$list_id);
    		$_map['list_id']=array('eq',$list_id);
    	}
    	$search=I('search','');
    	if(!empty($search)){
    		$this->assign('search',$search);
    		$_map['name'] = array('like','%'.$search.'%');
        }
        $_map['_logic'] = 'and';
        
        $count=$this->_product->where($_map)->count();
        $Page=new Page($count,5);
        $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
        $data=$this->_product->where($_map)->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $show=$Page->show();
        $this->assign('page',$show);
        
        $arr = array(); //声明一个空数组
        //遍历商品信息
        foreach($data as $v){
            $role_ids = $this->_pro_attr->field('attr_id,value_id')->where(array('pro_id'=>array('eq',$v['id'])))->select();
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
        $this->assign('list',$arr);
        $this->display();    
    }

    //浏览 属性信息
    public function rolelist(){

        //获取当前商品的属性信息
        $rolelist = $this->_pro_attr->where(array('pro_id'=>array('eq',I('id'))))->select();

        $myrole = array(); //定义空数组
        //对商品的属性进行重组
        foreach($rolelist as $v){
            $myrole[$v['attr_id']][] = $v['value_id'];
        } 

        //查询节点信息
        $list = $this->_attribute->select();
        $attrlist=array();
        foreach($list as $l){
            $map2=array();
            $map=D($l['title'])->select();
            foreach ($map as $m) {
               if(in_array($m['id'],$myrole[$l['id']])){
                 $map2[]=$m;
               } 
            }
            $l['value']=$map2;
            $attrlist[]=$l;
        }
        //查询当前商品信息
        $product = $this->_product->where(array('id'=>array('eq',I('id'))))->find();


        
        //分配数据
        $this->assign("list",$attrlist);
        //分配当前商品信息
        $this->assign('product',$product);
        //分配该商品的属性信息
        $this->assign('role',$myrole);

        $p=I('get.p/d',1);
        $this->assign('p',$p);
        //加载模板
        $this->display();
    }

    //为属性设置值
    public function attrlist(){
        $pro_id=I('pro_id');
        $pro_name=I('pro_name');
        $attr_id=I('attr_id');

        $data=$this->_attribute->find($attr_id);
        //查找该商品_属性关系
        $map=array();
        $map['pro_id']=array('eq',$pro_id);
        $map['attr_id']=array('eq',$attr_id);
        $map['_logic']='and';
        $info = $this->_pro_attr->where($map)->field('value_id')->select();
        $ro_values=array();
        foreach ($info as $i) {
            $ro_values[]=$i['value_id'];
        }

        //查找对应属性的表名
        $title = $this->_attribute->find($attr_id);

        //获取对应属性的值
        $value = D($title['title'])->select();
        
        //向模板输出商品名
        $this->assign('pro_name',$pro_name);
        //向模板输出属性名
        $this->assign('title',$title);
        //向模板输出商品id
        $this->assign('pro_id',$pro_id);
        //向模板输出属性id
        $this->assign('attr_id',$attr_id);
        //向模板输出已有属性
        $this->assign('ro_values',$ro_values);
        //向模板遍历属性值
        $this->assign('value',$value);
        
        //加载模板
        $this->display();
    }

    //保存属性设置
    public function savelist(){
       $pro_id=I('post.pro_id');
       $attr_id=I('post.attr_id');
       $node=I('post.node');
       //删除原商品_属性关系
       $map=array();
       $map['pro_id']=array('eq',$pro_id);
       $map['attr_id']=array('eq',$attr_id);
       $map['_logic']='and';
       $info= $this->_pro_attr->where($map)->field('id')->select();
       foreach ($info as $i) {
           if($this->_pro_attr->delete($i['id'])>0){
              
           }else{
              $this->error('原属性删除失败！',U('rolelist','id='.$pro_id));
              exit;
           }
       }
       //添加新商品_属性关系
       foreach ($node as $n) {
           $_POST['value_id']=$n;
           $_POST['pro_id']=$pro_id;
           $_POST['attr_id']=$attr_id;
           if(!$this->_pro_attr->create()){
              exit($this->_pro_attr->getError());
           }else{
              if($this->_pro_attr->add()<=0){
              $this->error('新属性添加失败！',U('rolelist','id='.$pro_id));
              exit;
              }
           }
       }
       $this->success('新属性保存成功！',U('rolelist','id='.$pro_id));

    }

    //删除商品
    public function delete(){
        $id=I('id');
        $p=I('p');
        if($this->_product->delete($id)<=0){
            $this->error('删除商品失败！',U('index','p='.$p));
            exit;
        }else{
            $data=$this->_pro_attr->where('pro_id='.$id)->field('id')->select();
            foreach ($data as $value) {
                if($this->_pro_attr->delete($value['id'])<=0){
                   $this->error('删除商品属性表失败！',U('index','p='.$p)); 
                   exit;
                }
            }
            $data=$this->_pro_num->where('pro_id='.$id)->field('id')->select();
            if($this->_pro_num->delete($data[0]['id'])>0){
                $this->success('删除商品成功！',U('index','p='.$p));
            }else{
                $this->error('删除商品编号表失败！',U('index','p='.$p));
            }
            
        }
    }

    //添加商品
    public function add(){
        //实例化
        $category = D('List');
        //获取分类信息
        $list = $category->getHomeCate();
        $this->assign('list',$list);
        $this->display();
    }
    
    //文本编辑器
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }    

    //商品添加
    public function insert(){
        if(!$this->_product->create()){
            exit($this->_product->getError());
        }else{
            $id=$this->_product->add();
            if($id<=0){
               $this->error('商品添加失败！');
            }else{
               $list_id=$_POST['list_id'];
               $pro_num=$_POST['number'];
               unset($_POST);
               $_POST['pro_id']=$id;
               $_POST['pro_num']=$pro_num;
               $_POST['list_id']=$list_id;
               if(!$this->_pro_num->create()){
                  $this->error('商品编号添加失败！');
               }
               if($this->_pro_num->add()>0){
                  $this->success('商品添加成功！',U('index'));
               }else{
                  $this->error('商品编号添加失败！');
               } 
               
            } 
        }
        
    }

    //商品修改
    public function edit(){
       //实例化
        $category = D('List');
        //获取分类信息
        $list = $category->getHomeCate();
        $this->assign('list',$list);
        
        $data=$this->_product->find(I('id'));
        $this->assign('item',$data);
        $this->assign('id',I('id'));
        $this->assign('p',I('p'));
        $this->display();   
    }

    //商品更新
    public function update(){
        if(!$this->_product->create()){
            exit($this->_product->getError());
        }else{
            $id=I('post.id',0);
            if($this->_product->where('id='.I('post.id'))->save()>0) {
               $this->success('商品修改成功！',U('index','p='.I('post.p')));
            }else {
               $this->error('商品修改失败！');
        }        
        }
      
    }

    //图片管理
    public function images(){
        $data=$this->_pro_img->where('pro_id='.I('id'))->select();
        $pro_name=$this->_product->field('name')->find(I('id'));
        $this->assign('pro_name',$pro_name);
        $this->assign('p',I('p'));
        $this->assign('list',$data);
        $this->display();
    }

    //删除图片
    public function del_img(){
        $data=$this->_pro_img->find(I('id'));
        if($data['is_face']==1){
            $this->error('不能删除封面图片！');
            exit;
        }else{
            $path='Uploads/'.$data['path'].$data['name'];
            $id=$data['pro_id'];
            if(!unlink($path)){
                $this->error('图片文件删除失败！',U('images','id='.$id));
            }
            if($this->_pro_img->delete(I('id'))>0){
                $this->success('图片删除成功！',U('images','id='.$id));
            }else{
                $this->error('图片表删除失败！',U('images','id='.$id));
            }
        }
    }

    //修改图片
    public function edit_img(){
        $data=$this->_pro_img->find(I('id'));
        $this->assign('item',$data);
        $this->display();
    }

    public function update_img(){
        $id=I('post.id');
        $pid=$this->_pro_img->field('pro_id')->find($id);
        if(!$this->_pro_img->create()){
            exit($this->_pro_img->getError());
        }else{
            
            if($this->_pro_img->save()>0) {
               $this->success('图片修改成功！',U('index','id='.$pid['pro_id']));
            }else {
               $this->error('图片修改失败！',U('index','id='.$pid['pro_id']));
            }        
        }
    }

}
