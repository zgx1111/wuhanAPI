<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/12/19
 * Time: 14:54
 */

namespace app\lib\exception;


class StoreMissException extends BaseException
{
    public $code=404;
    public $msg='请求的门店id不存在';
    //自定义错误码
    public $errorCode=40001;
}