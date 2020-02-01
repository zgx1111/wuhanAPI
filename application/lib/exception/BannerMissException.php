<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 20:18
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    //banner找不到
    public $code=404;
    public $msg='请求的banner不存在';
    //自定义错误码
    public $errorCode=40000;
}