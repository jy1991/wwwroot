<?php
namespace Admin\Controller;
class PlayerController extends AdminController {

    private $_player = null; //数据库操作类
    private $_work = null; //权限表数据库对象
    private $_player_work = null; //角色——权限表数据库对象
    private $_admin_player = null; //用户——角色表数据库对象

    //初始化操作
    public function _initialize(){
        parent::_initialize();
        $this->_player = D('player');
        $this->_work = D('work');
        $this->_player_work = D("player_work");
        $this->_admin_player = D("admin_player");
    }

	public function index(){
        $Player=M('player');
        $data=$Player->order('player_id asc')->select();
        $this->assign('list',$data);
        $this->display();
    }
    public function add(){
        $this->display('Player/add');
    }
    public function insert(){
        M('player')->create();
        if(M('player')->add()>0) {
            $this->success('角色添加成功！',U('index'));
        }else {
            $this->error('角色添加失败！');
        }
    }
    public function delete() {
        $player_id=I('get.id/d',0);
        if(M('player')->where('player_id='.$player_id)->delete()>0) {
            $this->success('角色删除成功！',U('index'));
        }else {
            $this->error('角色删除失败！');
        }           
    }
    public function edit() {
        $id=I('get.id/d',0);
        $data=M('player')->where('player_id='.$id)->find();
        if($data===null) {
            $this->redirect('index');
            exit;
        }
        $this->assign('item',$data);
        $this->display();
    }

    public function update() {
        M('player')->create();
        $player_id=I('post.player_id/d',0);
        if(M('player')->where('player_id='.$player_id)->save()>0) {
            $this->success('角色修改成功！',U('index'));
        }else {
            $this->error('角色修改失败！');
        }
    }

    //为角色分配权限
    public function work(){
        $player_id=I('get.id/d',0);
        $player_name=I('get.name','');
        $Work=M('work');
        $data=$Work->order('id asc')->select();
        
        //查找该角色信息
        $role = $this->_player->where(array('player_id'=>array('eq', $player_id)))->find();
        //查找所有的节点
        $nodes = $this->_work->select();

        //获取该角色的权限
        $ro_node = $this->_player_work->where(array('player_id'=>array('eq',$role['player_id'])))->select();
        $ro_nodes = array();
        //遍历重组数组
        foreach($ro_node as $v){
            $ro_nodes[] = $v['work_id'];
        }
        //向模板分配该用户拥有的权限信息
        $this->assign('ro_nodes',$ro_nodes);
        //向模板分配节点信息
        $this->assign('player',$nodes);
        //向模板分配角色信息
        $this->assign('role',$role);
        
        //加载模板
        $this->display();
    }

    //为角色添加权限
    public function save(){
        if(empty($_POST['node'])){
            $this->error("必须选择一个权限！");
        }

        $player_id = $_POST['player_id'];

        //删除该角色的所有信息--避免重复添加
        $this->_player_work->where(array('player_id'=>array('eq',$player_id)))->delete();

        //循环添加
        foreach($_POST['node'] as $v){
            $data['player_id'] = $player_id;
            $data['work_id'] = $v;
            //执行添加
            $this->_player_work->data($data)->add();
        }

        $this->success("添加成功！",U('Player/index'));
    }    

}