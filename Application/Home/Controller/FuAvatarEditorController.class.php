<?php
namespace Home\Controller;
use Think\Controller;

class FuAvatarEditorController extends Controller{
    
    private $_avatar=null;

	public function _initialize(){
	    $this->_avatar=D('avatar');
	    if(empty($_SESSION['home_user'])){
           $this->error('请先登录！',U('Public/login'));
        exit;
        }
	}
	//加载编辑器
	public function avatar(){
		$this->display();
	}


	//执行上传 头像的方法
	public function upAvatar(){
		header('Content-Type: text/html; charset=utf-8');
		$result = array();
		$result['success'] = false;
		$successNum = 0;
		//定义一个变量用以储存当前头像的序号
		$avatarNumber = 1;
		$i = 0;
		$msg = '';
		//上传目录
		$dir = "./Uploads/avatar";
		//遍历所有文件域
		while (list($key, $val) = each($_FILES))
		{
			if ( $_FILES[$key]['error'] > 0)
		    {
				$msg .= $_FILES[$key]['error'];
			}
			else
			{
				$fileName = date("YmdHis").'_'.floor(microtime() * 1000).'_'.$this->createRandomCode(8);
				//处理原始图片（默认的 file 域的名称是__source，可在插件配置参数中自定义。参数名：src_field_name）
				//如果在插件中定义可以上传原始图片的话，可在此处理，否则可以忽略。
				if ($key == '__source')
				{
					//当前头像基于原图的初始化参数，用于修改头像时保证界面的视图跟保存头像时一致。帮助提升用户体验度。修改头像时设置默认加载的原图的url为此图片的url+该参数即可。
					$initParams = $_POST["__initParams"];
					$virtualPath = "$dir/php_source_$fileName.jpg";
					$result['sourceUrl'] = '/' . $virtualPath.$initParams;
					move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
					/*
						可在此将 $result['sourceUrl'] 储存到数据库
					*/
					$successNum++;
				}
				//处理头像图片(默认的 file 域的名称：__avatar1,2,3...，可在插件配置参数中自定义，参数名：avatar_field_names)
				else if (strpos($key, '__avatar') === 0)
				{
					$virtualPath = "$dir/php_avatar" . $avatarNumber . "_$fileName.jpg";
					$result['avatarUrls'][$i] = "php_avatar" . $avatarNumber . "_$fileName.jpg";
					move_uploaded_file($_FILES[$key]["tmp_name"], $virtualPath);
					/*
						可在此将 $result['avatarUrls'][$i] 储存到数据库
					*/
					$successNum++;
					$i++;
				}
				/*
				else
				{
					如下代码在上传接口upload.php中定义了一个user=xxx的参数：
					var swf = new fullAvatarEditor("swf", {
						id: "swf",
						upload_url: "Upload.php?user=xxx"
					});
					在此即可用$_POST["user"]获取xxx。
				}
				*/
			}
		}
		$result['msg'] = $msg;
		if ($successNum > 0)
		{
			$result['success'] = true;

		}

		//将头像信息插入到数据库======================================
		//拼装数据
		
		$data['largeavatar'] = $result['avatarUrls'][0];
		$data['middleavatar'] = $result['avatarUrls'][1];
		$data['smallavatar'] = $result['avatarUrls'][2];
		$data['user_id'] = $_SESSION['home_user']['id'];
		$data['display'] = '0';
			//根据id 检查是否能取出数据
		if($avatarinfo = $this->_avatar->where(array('user_id'=>$_SESSION['home_user']['id']))->find()){
			//执行添加操作
			if($this->_avatar->where(array('id'=>$avatarinfo['id']))->save($data) > 0){
				//成功
				//删掉以前数据
				@unlink("$dir/".$avatarinfo['largeavatar']);
				@unlink("$dir/".$avatarinfo['middleavatar']);
				@unlink("$dir/".$avatarinfo['smallavatar']);

			}else{
				$result['success'] = false;
				$result['msg'] = "数据库保存失败！";
				//删除已上传数据
				for($i=0; $i<=2; $i++){
					@unlink("$dir/".$result['avatarUrls'][$i]);
				}
			}
		}else{
			//执行添加操作
			if($this->_avatar->add($data) > 0){
				//成功
			}else{
				$result['success'] = false;
				$result['msg'] = "数据库添加失败！";
				//删除已上传数据
				for($i=0; $i<=2; $i++){
					@unlink("$dir/".$result['avatarUrls'][$i]);
				}
			}
		}
		
		//====================================================
		//返回图片的保存结果（返回内容为json字符串）
		print json_encode($result);
	}



	/**************************************************************
		*  生成指定长度的随机码。
		*  @param int $length 随机码的长度。
		*  @access public
		**************************************************************/
	private function createRandomCode($length){
		$randomCode = "";
		$randomChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		for ($i = 0; $i < $length; $i++)
		{
			$randomCode .= $randomChars { mt_rand(0, 35) };
		}
		return $randomCode;
	}




}


