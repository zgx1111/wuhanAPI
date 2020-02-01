<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/12/19
 * Time: 14:57
 */

namespace app\lib\exception;


class StoreShutDoorException extends BaseException
{
    public $code=404;
    public $msg='请求的门店关门';
    //自定义错误码
    public $errorCode=40002;

}