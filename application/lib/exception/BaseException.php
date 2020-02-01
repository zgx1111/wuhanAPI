<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 20:13
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{
    //HTTP 状态码
    public $code=400;

    //详细错误信息
    public $msg='参数错误';

    //自定义错误码
    public $errorCode=10000;

    //构建构造函数
    public function __construct($param=[])
    {
        if(!is_array($param))
        {
            return;
        }
        if(array_key_exists('code',$param))
        {
            $this->code = $param['code'];
        }
        if(array_key_exists('msg',$param))
        {
            $this->msg = $param['msg'];
        }
        if(array_key_exists('errorCode',$param))
        {
            $this->errorCode = $param['errorCode'];
        }
    }
}