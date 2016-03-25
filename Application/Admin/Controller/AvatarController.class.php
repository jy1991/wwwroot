<?php
namespace Admin\Controller;
class AvatarController extends AdminController {

    private $_user = null; 
    private $_avatar = null;
    private $_s=null; 
    
    //初始化操作
    public function _initialize(){
        parent::_initialize();
        $this->_user = D('user');
        $this->_avatar = D('avatar');
        $this->_s='';
    }
   
    public function index(){
        $search=I('search','');
        $display=I('display','');
        $this->assign('search',$search);
        $this->assign('display',$display);
        
        if(!empty($display)){
            switch($display){
                case 0:
                $this->_s=array("display"=>'0');
                break;
                case 1:
                $this->_s=array("display"=>'1');
                break;
                case 2:
                $this->_s=array("display"=>'2');
                break;
                case 3:
                $this->_s='';
                break;
                default:
                $this->_s='';
            }
        }

        if(!empty($search)){
            $this->_s=array("user_id"=>$search);
        }

        $count=$this->_avatar->where($this->_s)->count();
        $Page=new Page($count,5);
        $data=$this->_avatar->where($this->_s)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $Page->setConfig('theme',"<li><a>%totalRow% %header% %nowPage%/%totalPage% 页</a></li><li>%upPage%</li><li>%downPage%</li><li>%first%</li><li>%prePage%</li><li>%linkPage%</li><li>%nextPage%</li><li>%end%</li>");
        $show=$Page->show();
        
        $this->assign('page',$show);

        $this->assign('list',$data);
        $this->display();
    }


    public function pass(){
        $id=I('id');
        $_POST['display']=1;
        if(!$this->_avatar->create()){
            exit($this->_avatar->getError());
        }else{
            if($this->_avatar->where('id='.$id)->save()>0){
                $this->success('头像审核通过! ',U('index'));
            }else{
                $this->error('出错啦! ',U('index'));
            }
        }
    }

    public function no_pass(){
        $id=I('id');
        $_POST['display']=2;
        if(!$this->_avatar->create()){
            exit($this->_avatar->getError());
        }else{
            if($this->_avatar->where('id='.$id)->save()>0){
                $this->success('头像审核不通过! ',U('index'));
            }else{
                $this->error('出错啦! ',U('index'));
            }
        }
    }

    public function delete(){
        $id=I('id');
        $_POST['largeavatar']='avatar_no_pass.jpg';
        $_POST['middleavatar']='avatar_no_pass.jpg';
        $_POST['smallavatar']='avatar_no_pass.jpg';
        $save['largeavatar']='avatar_no_pass.jpg';
        $save['middleavatar']='avatar_no_pass.jpg';
        $save['smallavatar']='avatar_no_pass.jpg';
        if(!$this->_avatar->create()){
            exit($this->_avatar->getError());
        }else{
            $data=$this->_avatar->find($id);
            if(unlink('./Uploads/avatar/'.$data['largeavatar']) && unlink('./Uploads/avatar/'.$data['middleavatar']) && unlink('./Uploads/avatar/'.$data['smallavatar']) )
            {
                if($this->_avatar->where('id='.$id)->save($save)>0){
                   $this->success('头像图片删除成功! ',U('index')); 
                }else{
                   $this->error('出错啦! ',U('index'));
                }
            }else{
                 $this->error('头像图片删除失败! ');
            }
        }
    }    


}

