<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/20
 * Time: 17:14
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code=401;
    public $msg='Token令牌已过期或无效Token';
    public $errorCode=10001;
}