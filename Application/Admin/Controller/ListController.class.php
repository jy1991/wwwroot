<?php 
namespace Admin\Controller;

//分类 控制器
class ListController extends AdminController{
	
    public function index(){
		
		//实例化
		$category = D('List');
		//获取分类信息
		$list = $category->getAdminCate();
		
		$this->assign('list',$list);

		$this->display();

	}

	public function add(){
		$pid=I('pid/d',0);
		//实例化
		$category = D('List');
		//获取分类信息
		$list = $category->getHomeCate();
		$this->assign('pid',$pid);
		$this->assign('list',$list);
		$this->display();
	}
    
    public function edit(){
    	$id=I('id/d',0);
		//实例化
		$category = D('List');
		//获取分类信息
		$list = $category->where('id='.$id)->find();
		$this->assign('list',$list);
		$this->display();
    }

    public function update() {
        $category = D('List')->create();
        $id=I('post.id/d',0);
        if(D('List')->where('id='.$id)->save()>0) {
            $this->success('分类修改成功！',U('index'));
        }else {
            $this->error('分类修改失败！');
        }
    }


	//加载添加页面
	//执行添加信息
	public function insert(){
		$pid=I('post.pid/d',0);
		$list=D('List')->field('path')->where('id='.$pid)->find();
		$path=$list['path'].$pid.',';
		$_POST['path']=$path;
		//实例化
		$category = D('List');
		//初始化数据
		if(!$category->create()){
			$this->error($this->_model->getError());
			exit;
		};
		//执行添加
		if($category->add()>0){
			$this->success("分类添加成功！",U('List/index'));
		}else{
			$this->error("分类添加失败");
		}
	}




	//删除
	public function delete(){
		//实例化
		$category = D('List');
		//拼装删除条件
		$map['id'] = array('eq',I('id/d',0));
		$map['path'] = array('like','%'.I('id/d',0).'%');
		$map['_logic'] = 'or';
		if($category->where($map)->delete()>0){
			$this->success("删除成功！",U('List/index'));
		}else{
			$this->error("删除失败");
		}
	}

	/**
	 * 分类树显示
	*/
	public function treeList(){
		//实例化
		$category = D('List');
		//获取分类信息
		$list = $category->getHomeCate();
		//V($list);
		$this->assign('list',$list);
		//V($list);
		$this->display();
	}

}

