<?php 
	namespace Admin\Controller;
	
	class WorkController extends AdminController{
		private $_model = null; //数据库操作类

		//初始化操作
		public function _initialize(){
			parent::_initialize();
			$this->_model = D('Work');
		}

		//列表详情
		public function index(){
			//查询数据
			$list = $this->_model;
            $count= $list->count();
            $Page=new Page($count,10);
            $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
            $show=$Page->show();
            $data=$list->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		    $this->assign('page',$show);
			//分配变量
			$this->assign("list",$data);
			//加载模板
			$this->display();
		}
        
        public function add(){
        	$this->display('Work/add');
        }
        
		//执行添加操作
		public function insert(){

			if(!$this->_model->create()){
				$this->error($this->_model->getError());
				exit;
			}

			if($this->_model->add() > 0){
				$this->success("权限添加成功！",U('Work/index'));
			}else{
				$this->error("权限添加失败！");
			}
		}


		//删除操作
		public function delete(){
			if($this->_model->delete($_GET['id']) > 0){
				$this->success("权限删除成功！",U('Work/index'));
			}else{
				$this->error("权限删除失败");
			}
		}

		//加载修改页面 
		public function edit(){
			//查出数据
			$vo = $this->_model->where(array('id'=>array('eq',I('id'))))->find();
			//向模板分配数据
			$this->assign('item',$vo);
			//加载模板
			$this->display();
		}

		//执行修改操作
		public function update(){
			//初始化
			if(!$this->_model->create()){
				$this->error($this->_model->getError());
				exit;
			}
			//执行修改 
			if($this->_model->save() >= 0){
				$this->success("权限修改成功！",U('Work/index'));
			}else{
				$this->error("权限修改失败");
			}
		}

		
	}
