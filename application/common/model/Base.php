<?php
namespace app\common\model;

use think\Model;

class Base extends Model{
	//自动填充时间戳
	protected $autoWriteTimestamp = true;
	//新增方法
	public function add($data){
		if(!is_array($data)){
			exception('传递参数不合法');
		}
		$this->allowField(true)->save($data);
		return $this->id;
	} 
}