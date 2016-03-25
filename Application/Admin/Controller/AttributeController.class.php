<?php 
	namespace Admin\Controller;
	
	class AttributeController extends AdminController{
		private $_model = null; //数据库操作类

		//初始化操作
		public function _initialize(){
			parent::_initialize();
			$this->_model = D('Attribute');
		}

		//列表详情
		public function index(){
			//查询数据
			$list = $this->_model;
            $count= $list->count();
            $Page=new Page($count,5);
            $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
            $show=$Page->show();
            $data=$list->order('id asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		    $this->assign('page',$show);
			
			$list=array();
			foreach ($data as  $value) {
				$value['value']=D($value['title'])->order('id asc')->select();
				$list[]=$value;
            }
            //分配变量
			$this->assign("list",$list);
            
            //加载模板
			$this->display();
		}
        
        public function add(){
        	$this->display();
        }
        
		//执行添加操作
		public function insert(){

			if(!$this->_model->create()){
				$this->error($this->_model->getError());
				exit;
			}

			if($this->_model->add() > 0){
				$this->success("属性添加成功！",U('index'));
			}else{
				$this->error("属性添加失败！");
			}
		}


		//删除操作
		public function delete(){
			if($this->_model->delete(I('id')) <= 0){
				$this->error("属性删除失败！",U('index'));
				exit;
			}else{
				$data=D('pro_attr')->where('attr_id='.I('id'))->field('id')->select();
				foreach ($data as $value) {
					if(D('pro_attr')->delete($value['id'])<=0){
						$this->error("商品属性表删除失败！",U('index'));
					    exit;
					}
				}
				$this->success("商品属性表删除成功！",U('index'));
			}
		}

		//加载修改页面 
		public function edit(){

			//查出数据
			$title = $this->_model->where(array('id'=>array('eq',I('id'))))->find();
			//向模板分配数据
			$this->assign('title',$title);
			$data=D($title['title'])->select();
			$this->assign('list',$data);
            $this->assign('pid',I('pid'));
			//加载模板
			$this->display();
		}

		//删除属性值
		public function del_value(){
            if(D(I('title'))->delete(I('id'))<=0){
               $this->error("属性值删除失败！",U('edit','id='.I('pid')));
               exit;	
            }else{
               $map=array();
               $map['attr_id']=array('eq',I('pid'));	
               $map['value_id']=array('eq',I('id'));
               $map['_logic']='and';
               $data=D('pro_attr')->where($map)->select();	
               foreach ($data as  $value) {
               	  if(D('pro_attr')->delete($value['id'])<=0){
                      $this->error("商品属性表删除失败！",U('edit','id='.I('pid')));
                      exit;	
               	  }
               }
               $this->success("商品属性表删除成功！",U('edit','id='.I('pid')));
            }
		}

		//编辑属性值
		public function edit_value(){
			$id=I('id');
			$pid=I('pid');
			$title=I('title');
			$data=D($title)->find($id);
			$this->assign('item',$data);
			$this->assign('title',$title);
			$this->assign('pid',$pid);
			$this->display();
		}

		//编辑属性值
		public function add_value(){
            $this->assign('title',I('title'));
			$this->assign('name',I('name'));
			$this->display();
		}

		//编辑属性值
		public function insert_value(){

			$title=I('post.title');
            if(!D($title)->create()){
                $this->error(D($title)->getError());
                exit;
            }
			if(D($title)->add()>0){
				$this->success("属性值添加成功！",U('index'));
			}else{
				$this->error("属性值添加失败！",U('index'));
			}
		}				

		//修改属性值操作
		public function update(){
			$title=I('post.title');
            if(!D($title)->create()){
                $this->error(D($title)->getError());
                exit;
            }

			//执行修改 
			if(D($title)->where('id='.I('post.id'))->save() > 0){
				$this->success("属性值修改成功！",U('edit','id='.I('post.pid')));
			}else{
                $this->error("属性值修改失败",U('edit','id='.I('post.pid')));
			}
		}

		
	}


