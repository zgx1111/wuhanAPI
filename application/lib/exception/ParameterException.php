<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/12
 * Time: 15:28
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    //参数错误异常
    public $code=404;
    public $msg='参数错误';
    //自定义错误码
    public $errorCode=40000;

}