<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//自定义函数
function pagination($obj){
	if(!$obj) {
        return '';
    }

    $params = request()->param();
    return '<div class="imooc-app">'.$obj->appends($params)->render().'</div>';
}

//获取栏目名称
function getCatName($catId){
	if(!$catId){
		return '';
	}
	$cats = config('cat.lists');
	return !empty($cats[$catId]) ? $cats[$catId] : '';
}

//状态
function status($id,$status){
	$controller = request()->controller();
	$sta = $status == 1 ? 0 : 1;
	//$url = url($controller.'/status',['id' => $id ,'status' => $status]);
	if($status == 1) {
		$url = url($controller.'/status',['id' => $id ,'status' => 0]);
        $str = "<a href='javascript:;' title='修改成审核' status_url='".$url."' onclick='app_status(this)'><span class='label label-success radius'>正常</span></a>";
    }elseif($status == 0) {
    	$url = url($controller.'/status',['id' => $id ,'status' => 1]);
        $str = "<a href='javascript:;' title='修改成正常' status_url='".$url."' onclick='app_status(this)'><span class='label label-danger radius'>待审</span></a>";
    }

    return $str;
}

function isYesNo($str) {
    return $str ? '<span style="color:red"> 是</span>' : '<span > 否</span>';
}

function show($status,$message,$data = [],$httpCode = 200){
	//通用化api接扣数据输出
	$data = [
		'status' => $status,
		'message' => $message,
		'data' => $data,

	];

	return json($data,$httpCode);

}
