<?php
namespace app\common\lib;
//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;

class Upload{
	//图片上传
	public static function image(){
		if(empty($_FILES['file']['tmp_name'])){
			exception('您提交的图片数据不合法',404);
		}
		$file = $_FILES['file']['tmp_name'];
		$pathinfo = pathinfo($file);
		$ext = $pathinfo['extension'];
		//七牛sdk使用
		//构建一个鉴权对象
		$config = config('qiniu');
		$auth = new Auth($config['ak'],$config['sk']);
		//生成token
		$token = $auth->uploadToken($config['bucket']);
		//上传到七牛云保存的文件名
		$key = date('Y').'/'.date('m').'/'.substr(md5($file),0,5).date('YmdHis').rand(0,9999).'.'.$ext;
		//初始化uploadManager类
		$uploadMgr = new UploadManager();
		//使用list函数
		$res = $uploadMgr->putFile($token,$key,$file);
		//halt($res);
		list($ret,$err) = $uploadMgr->putFile($token,$key,$file);

		if($err !== null){
			return null;
		}else{
			return $key;
		}
	}
}
