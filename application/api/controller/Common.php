<?php
namespace app\api\controller;

use think\Controller;
use app\common\lib\exception\ApiException;
use app\common\lib\Aes;
use app\common\lib\IAuth;
use app\common\lib\Time;
use think\Cache;

//公共api
class Common extends Controller{

	public $headers = '';

	/**
     * page
     * @var string
     */
    public $page =1;

    /**
     * 每页显示多少条
     * @var string
     */
    public $size = 10;
    /**
     * 查询条件的起始值
     * @var int
     */
    public $from = 0;

	//初始化方法
	public function _initialize(){
		$this->checkRequestAuth();
		//$this->testAes();
	}

	//验证sign 每次app请求的数据是否合法
	public function checkRequestAuth(){
		//获取headers
		$headers = request()->header();
		//判断sign
		if(empty($headers['sign'])){
			throw new ApiException('sign不存在',400);
		}
		//判断app_type
		if(!in_array($headers['app_type'],config('app.apptypes'))){
			throw new ApiException('app_type不合法',400);
		}

		if(!IAuth::checkSignPass($headers)){
			throw new ApiException('授权失败',401);
		}

		Cache::set($headers['sign'],1,config('app.app_sign_cache_time'));


		$this->headers = $headers;
	}
	//测试aes加密算法
	public function testAes(){
		$data = [
			'did' => '123456',
			'version' => '1',
			'time' => Time::get13TimeStamp(),
		];
		echo IAuth::setSign($data); exit;
		//解密
		//Upris8QdeCwjTNYEeBUB2/j8tlWUeKk7xpppR8cOpS/6UmYXtW744arQUpKFD75v
		//$str = '1DugOVr70hrizNXF5Wm63NcK464arh18lvpT8MHxSu4=';
		//echo (new Aes())->decrypt($str); exit;
		/*//$str = 'id=1&ms=45&name=xiedongmin';
		$md = 'uVbM2wg0ydqfjmZJIL3KnFlvntTn3zF+lwLGAY9Iepc=';
		//echo (new Aes())->encrypt($str); exit;
		echo (new Aes())->decrypt($md); exit;*/
	}
	//获取处理的新闻数据
	public function getDealNews($news = []){
		if(empty($news)){
			return [];
		}
		$cats = config('cat.lists');

		foreach($news as $key => $new){
			$news[$key]['catname'] = $cats[$new['catid']] ? $cats[$new['catid']] : '-';
		}

		return $news;
	}

	 /**
     * 获取分页page size 内容
     */
    public function getPageAndSize($data) {
        $this->page = !empty($data['page']) ? $data['page'] : 1;
        $this->size = !empty($data['size']) ? $data['size'] : config('paginate.list_rows');
        $this->from = ($this->page - 1) * $this->size;
    }
}