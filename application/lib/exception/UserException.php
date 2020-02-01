<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/22
 * Time: 16:23
 */

namespace app\lib\exception;


use think\Exception;

class UserException extends BaseException
{
    public $code = 404;
    public $msg = '当前用户不存在';
    public $errorCode = 60000;

}