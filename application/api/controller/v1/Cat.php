<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
class Cat extends Common{
	//读取栏目
	public function read(){
		$cats  = config('cat.lists');

		$result[] = [
			'catid' => 0,
			'catname' => '首页',
		];

		foreach($cats as $catId => $catName){
			$result[] = [
				'catid' => $catId,
				'catname' => $catName,
			];
		}

		return show(config('code.success'),'OK',$result,200);
	}
}