<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 21:34
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    //订单错误异常
    public $code=404;
    public $msg='订单id不存在';
    //自定义错误码
    public $errorCode=80000;
}