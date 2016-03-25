<?php
	namespace Admin\Controller;
    use Think\Controller;
	class UploadController extends Controller{


		//=====================================================================
		//使用uploadify插件上传
		public function uploadify(){

			$this->display();
		}

		//执行 uploadify上传 的函数
		public function uploadifyUpload(){
			$upload = new \Think\Upload();// 实例化上传类
		    $upload->maxSize   =     3145728 ;// 设置附件上传大小
		    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'mp4');// 设置附件上传类型
		    $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
		    $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->thumbPrefix = 'm_,s_';
            $upload->thumbMaxWidth = '400,100';
            $upload->thumbMaxHeight = '400,100';
            $upload->thumb = true;

            
		    // 上传文件
		    $info   =   $upload->upload();

            if(!$info) {// 上传错误提示错误信息
		        echo $upload->getError();
		    }else{// 上传成功

		    echo __ROOT__.'/Uploads/'.$info['Filedata']['savepath'].$info['Filedata']['savename'];

		    $_POST['name']=$info['Filedata']['savename'];
		    $_POST['path']=$info['Filedata']['savepath'];
		    $file=fopen("pro_img.txt","a+");
            fwrite($file,'文件名：'.$info['Filedata']['savename'].' 路径：'.$info['Filedata']['savepath'].' ');
            if(!D('pro_img')->create()){
			   fwrite($file,'error');
			   exit;
		    };
		    //执行添加商品图片表
		    if(D('pro_img')->add()>0){
			   fwrite($file,"图片上传成功 商品id：".$_POST['pro_id'].' // ');
		    }else{
			   fwrite($file,"图片上传失败 //");
		    }
		    fclose($file);
		    }

		}

	}

