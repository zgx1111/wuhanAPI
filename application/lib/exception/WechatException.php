<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 22:24
 */

namespace app\lib\exception;


class WechatException extends BaseException
{
    public $code=400;
    public $msg='微信服务器接口调用失败';
    public $errorCode=999;

}