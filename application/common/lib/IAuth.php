<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:27
 */
namespace app\common\lib;
use app\common\lib\Aes;
use think\Cache;
/**
 * Iauth相关
 * Class IAuth
 */
class IAuth {

    /**
     * 设置密码
     * @param string $data
     * @return string
     */
    public static  function setPassword($data) {
        return md5($data.config('app.password_pre_halt'));
    }

    //生成每次请求的sign

    public static function setSign($data = []){
    	//字段排序
    	ksort($data);
    	//拼接成过程化模式的参数传递数据
    	$string = http_build_query($data);
    	//通过aes加密
    	$str = (new Aes())->encrypt($string);
    	//转换成大写
    	//$strs = strtoupper($str);
    	return $str;
    } 

    //检查sign是否正常
    public static function checkSignPass($data){
    	//解密sign
    	$str = (new Aes())->decrypt($data['sign']);
    	if(empty($str)){
    		return false;
    	}
    	parse_str($str,$arr);
    	if(!is_array($arr) || empty($arr['did']) || $arr['did'] != $data['did']){
    		return false;
    	}
         if(!config('app_debug')) {
            if ((time() - ceil($arr['time'] / 1000)) > config('app.app_sign_time')) {
                return false;
            }
            //echo Cache::get($data['sign']);exit;
            // 唯一性判定
            if (Cache::get($data['sign'])) {
                return false;
            }
        }

    	return true;
    }

}