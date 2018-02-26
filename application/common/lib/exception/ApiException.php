<?php
namespace app\common\lib\exception;

use think\Exception;
//内部api异常
class ApiException extends Exception{

	public $message = '';
	public $httpCode = 500;
	public $code = 0;

	public function __contruct($message = '',$httpCode = 0,$code = 0){
		$this->httpCode = $httpCode;
		$this->message = $message;
		$this->code = $code;
	}
}