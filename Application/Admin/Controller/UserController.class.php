<?php
namespace Admin\Controller;
class UserController extends AdminController {

	private $_user = null; //数据库操作类
    private $_search = null;
   
	//初始化操作
	public function _initialize(){
		parent::_initialize();
		$this->_user = D('user');
		$this->_search ='';
    }

	public function index(){
		$search=I('search','');
		if(!empty($search)){
            $search_value='%'.$search.'%';
            $this->_search=array('like',$search_value);
            $this->_search=array("user"=>$this->_search);
		}
		    $count=$this->_user->where($this->_search)->count();
        $Page=new Page($count,5);
        $data=$this->_user->where($this->_search)->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
        $show=$Page->show();
        
		    $this->assign('page',$show);
        
        $this->assign('list',$data);
        $this->assign('search',$search);

        $this->display();
    }

    public function delete(){
        $id=I('id/d',0);
        $p=I('p/d',1);
        $search=I('search','');

        if($this->_user->delete($id)>0) {
            $this->success('用户表删除成功！',U('index',array('p'=>$p,'search'=>$search)));
        }else{
            $this->error('用户表删除失败！',U('index',array('p'=>$p,'search'=>$search)));
        }

    }

    public function display2(){
        $id=I('id/d',0);
        $p=I('p/d',1);
        $search=I('search','');
        $data=$this->_user->field('id,display')->find($id);
        $data['display']=($data['display']==1)?0:1;
        if(!$this->_user->create($data)){
          exit($this->_user->getError());
        }
        if($this->_user->save()>0) {
            $this->success('状态修改成功！',U('index',array('p'=>$p,'search'=>$search)));
        }else{
            $this->error('状态修改失败！',U('index',array('p'=>$p,'search'=>$search)));
        }

    } 

    public function edit(){
        $id=I('id/d',0);
        $p=I('p/d',1);
        $search=I('search','');
        $data=$this->_user->find($id);
        $this->assign('item',$data);
        $this->assign('p',$p);
        $this->assign('search',$search);
        $this->display();
    } 

    public function update(){
        $id=I('post.id/d',0);
        $p=I('post.p/d',1);
        $search=I('post.search','');  

      if(I('post.pass')==''){
         unset($_POST['pass']);
         unset($_POST['repass']);
      }

      if(!$this->_user->create()){
          exit($this->_user->getError());
      }
          
      if($this->_user->save()>0) {
          unset($_SESSION['home_user']);
          $_SESSION['home_user']=$this->_user->find(I('post.id'));
          $this->success('用户修改成功！',U('index',array('p'=>$p,'search'=>$search)));
      }else {
          $this->error('用户修改失败！',U('index',array('p'=>$p,'search'=>$search)));
      }

    }  

}

