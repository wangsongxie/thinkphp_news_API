<?php
namespace app\admin\controller;

use think\controller;
use think\Request;
use app\common\lib\Upload;
class Image extends Base{

	public function upload0(){
		$file = Request::instance()->file('file');
		$info = $file->move('upload');
		if($info && $info->getPathname()){
			$data = [
				'status' => 1,
				'message' => 'OK',
				'data' => '/'.$info->getPathname(),
			];
			echo json_encode($data);exit;
		}
		echo json_encode(['status' => 0, 'message' => '上传失败']);
	}
	//七牛上传图片
	public function upload(){
		try{
			$image = Upload::image();
		}catch(\Exception $e){
			echo json_encode(['status' => 0, 'message' => $e->getMessage()]);
		}
		
		if($image){
			$data = [
				'status' => 1,
				'message' => 'OK',
				'data' => config('qiniu.image_url').'/'.$image,
			];
			echo json_encode($data);exit;
		}else{
			echo json_encode(['status' => 0,'message' => '上传失败']);
		}
	}
}