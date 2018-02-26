<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
class Rank extends Common{
	
	//根据阅读数排行
	public function index(){
		try{
			$rands = model('News')->getRankNormalNews();
			$rand = $this->getDealNews($rands);
		}catch(\Exception $e){
			return new ApiException($e->getMessage(),400);
		}

		//返回数据
		return show(config('code.success'),'OK',$rand,200);
	}
}