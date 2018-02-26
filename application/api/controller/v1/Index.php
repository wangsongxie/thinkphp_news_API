<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
class Index extends Common{
	
	//获取首页内容
	public function index(){
		$heads = model('News')->getIndexHeadNormalNews();
		$heads = $this->getDealNews($heads);

		$positions = model('News')->getPositionNormalNews();
		$positions = $this->getDealNews($positions);
		$result = [
			'heads' => $heads,
			'positions' => $positions,
		];

		return show(config('code.success'),'OK',$result,200);
	}
}