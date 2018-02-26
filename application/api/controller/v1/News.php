<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
class News extends Common{
	
	//新闻栏目列表页
	public function index(){

		$data = input('get.');		

		$whereData['status'] = config('code.status_normal');

		if(!empty($data['catid'])){
			$whereData['catid'] = input('get.catid',0,'initval');

		}
		
		//搜索功能
		if(!empty($data['title'])){
			$whereData['title'] = ['like','%'.$data['title'].'%'];
		}

		$this->getPageAndSize($data);
		$total = model('News')->getNewsCountByCondition($whereData);
		$news = model('News')->getNewsByCondition($whereData,$this->from,$this->size);
		
		$result = [
			'total' => $total,
			'page_num' => ceil($total / $this->size),
			'list' => $this->getDealNews($news),
		];

		return show(config('code.success'),'OK',$result,200);
	}

	//读取详情
	public function read(){

	}
}