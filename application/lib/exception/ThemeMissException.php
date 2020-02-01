<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17
 * Time: 0:40
 */

namespace app\lib\exception;


class ThemeMissException extends BaseException
{
    public $code=404;
    public $msg='请求的Theme不存在';
    public $errorCode=30000;
}