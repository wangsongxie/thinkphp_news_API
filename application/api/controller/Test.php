<?php

namespace app\api\controller;

use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
class Test extends Common{

	public function index(){
		return [
			'xiedongmim',
			'zhangsan',
		];
	}
	public function update($id = 0){
		return $id;
	}

	public function save(){
		/*if($data['ids']){
			echo 1;exit;
		}*/
		$data = input('post.');
		/*if($data['mt'] != 1){
			throw new ApiException('数据不合法',403);
		}*/
		//return json($data,201);
		return show(1,'OK',(new Aes())->encrypt(json_encode(input('post.'))),201);
	}
}