<?php
namespace Admin\Controller;
class MasterController extends AdminController {

    private $_admin = null; //数据库操作类
    private $_player = null; //角色表操作类
    private $_admin_player = null; //用户——角色表操作类
    private $_s=null;

    //初始化操作
    public function _initialize(){
        parent::_initialize();
        $this->_admin = D('admin');
        $this->_player = D('player');
        $this->_admin_player = D('admin_player');
    }

	public function index(){
        $s_search=I('search/d',0);
        $s_value=I('value','');
        $s_save=array();
        $s_save['search']=$s_search;
        $s_save['value']=$s_value;
        $this->assign('s',$s_save);

        $s_search=($s_search==0)?'admin_user':'name';
        if(!empty($s_value)){
            $s_value='%'.$s_value.'%';
            $this->_s=array('like',$s_value);
            $this->_s=array("$s_search"=>$this->_s);
        }
        $Admin=M('admin');
        $count=$Admin->where($this->_s)->count();
        $Page=new Page($count,5);
        $data=$Admin->where($this->_s)->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
        $show=$Page->show();
        
		$this->assign('page',$show);
        
        $arr = array(); //声明一个空数组
        //遍历用户信息
        foreach($data as $v){
            $role_ids = $this->_admin_player->field('player_id')->where(array('admin_id'=>array('eq',$v['id'])))->select();
            //定义空数组
            $roles = array();
            //遍历
            foreach($role_ids as $value){
                $roles[] = $this->_player->where(array('player_id'=>array('eq',$value['player_id']),'status'=>array('eq',1)))->getField('player_name');
            }
            $v['role'] = $roles; //将新得到角色信息放置到$v中
            $arr[] = $v;
        }
        $this->assign('list',$arr);
        $this->display();
    }
    public function add() {
    	$this->display();
    }

    public function insert() {
        $Admin=D('Admin');
        if(!$Admin->create()){
            exit($Admin->getError());
        }else{
           M('admin')->field('admin_user,admin_pass,name,phone,status,permission,addtime')->create();
           M('admin')->admin_pass=md5(M('admin')->admin_pass);
           if(M('admin')->add()>0) {
              $this->success('管理员添加成功！',U('index'));
           }else {
              $this->error('管理员添加失败！');
           } 
        }
        
    }

    public function delete() {
        $s_search=I('s_search/d',0);
        $s_value=I('s_value','');
        $id=I('get.id/d',0);
        if($id==1){
            $this->error('不能删除admin！'); 
        }        
        $p=I('get.p/d',1);
        if(M('admin')->delete($id)>0) {
        	$this->success('管理员删除成功！',U('index',array('p'=>$p,'search'=>$s_search,'value'=>$s_value)));
        }else {
        	$this->error('管理员删除失败！',U('index',array('p'=>$p,'search'=>$s_search,'value'=>$s_value)));
        }        	
    }

    public function edit() {
        $s_search=I('s_search/d',0);
        $s_value=I('s_value','');
    	$id=I('get.id/d',0);
        if($id==1 && $_SESSION['admin_user']['permission']!=3){
            $this->error('您没有修改admin的权限！'); 
        }
        $p=I('get.p/d',1);
    	$data=M('admin')->find($id);
    	if($data===null) {
    		$this->redirect('index');
    		exit;
    	}
        $data[p]=$p;
        $this->assign('s_search',$s_search);
        $this->assign('s_value',$s_value);
    	$this->assign('item',$data);
    	$this->display();
    }

    public function update() {
        $s_search=I('post.s_search/d',0);
        $s_value=I('post.s_value','');
        $p=I('post.p/d',1);
        M('admin')->create();
        M('admin')->admin_pass=md5(M('admin')->admin_pass);
        if(M('admin')->save()>0) {
            $this->success('管理员修改成功！',U('index',array('p'=>$p,'search'=>$s_search,'value'=>$s_value)));
        }else {
        	$this->error('管理员修改失败！',U('index',array('p'=>$p,'search'=>$s_search,'value'=>$s_value)));
        }
    }

    public function adminUser(){
        $admin_user=I('post.admin_user');
        if($admin_user == null){
           $this->ajaxReturn('0','json'); 
           exit;
        }
        M('admin')->create();
        $data=M('admin')->where(array('admin_user'=>$admin_user))->find();
        if(empty($data)){
            $this->ajaxReturn('1','json');
        }else{
            $this->ajaxReturn('2','json');
        }        
    }

    public function adminPass(){
        $pre_pass=I('post.pre_pass');
        M('admin')->create();
        $data=M('admin')->where(array('admin_user'=>$_SESSION['admin_user']['admin_user']))->find();
        if($data['admin_pass'] == md5($pre_pass)){
            $this->ajaxReturn('1','json');
        }else{
            $this->ajaxReturn('0','json');
        }        
    }

    public function allpass() {
        $s_search=I('s_search/d',0);
        $s_value=I('s_value','');
        $id=I('get.id/d',0);
        if($id==1 && $_SESSION['admin_user']['permission']!=3){
           $this->error('您没有修改admin的权限！'); 
        }
        $p=I('get.p/d',1);
        $this->assign('id',$id);
        $this->assign('p',$p);
        $this->assign('s_search',$s_search);
        $this->assign('s_value',$s_value);
        $this->display();
    }

    public function pass(){
        $this->display();
    } 

    //分配 角色信息
    public function rolelist(){
        $s_search=I('s_search/d',0);
        $s_value=I('s_value','');
        //查询节点信息
        $list = $this->_player->where('status=1')->select();
        //查询当前用户信息
        $users = $this->_admin->where(array('id'=>array('eq',I('id'))))->find();

        //获取当前用户的角色信息
        $rolelist = $this->_admin_player->where(array('admin_id'=>array('eq',I('id'))))->select();

        $myrole = array(); //定义空数组
        //对用户的角色进行重组
        foreach($rolelist as $v){
            $myrole[] = $v['player_id'];
        }
        
        //分配数据
        $this->assign("list",$list);
        //分配当前用户信息
        $this->assign('users',$users);
        //分配该用户的角色信息
        $this->assign('role',$myrole);

        $this->assign('s_search',$s_search);
        $this->assign('s_value',$s_value);
      
        $p=I('get.p/d',1);
        $this->assign('p',$p);
        //加载模板
        $this->display();
    }
        
    //保存用户角色
    public function saverole(){

        $s_search=I('post.s_search/d',0);
        $s_value=I('post.s_value','');
            
        //判读必须选择一个角色
        if(empty($_POST['role'])){
            $this->error("请选择一个角色！");
        }

        $uid = $_POST['uid'];
        $p=$_POST['p'];

        //清除用户所有的角色信息，避免重复添加
        $this->_admin_player->where(array('admin_id'=>array('eq',$uid)))->delete();
    
        foreach(I('role') as $v){
            $data['admin_id'] = $uid;
            $data['player_id'] = $v;
            //执行添加
            $this->_admin_player->data($data)->add();

        }

        $this->success("角色分配成功",U('index',array('p'=>$p,'search'=>$s_search,'value'=>$s_value)));
            
    }     
   

}

