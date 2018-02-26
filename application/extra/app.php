<?php
/**
 * Created by PhpStorm.
 * User: baidu
 * Date: 17/7/28
 * Time: 上午12:29
 */

return [
    'password_pre_halt' => 'xiedongmin',// 密码加密盐
    'aeskey' => 'xiedongmindkdkdk', //aes秘钥 服务端和客户端保持一致
    'apptypes' => [
    	'ios',
    	'android',
    ],
    'app_sign_time' => 10,
    'app_sign_cache_time' => 20,
];