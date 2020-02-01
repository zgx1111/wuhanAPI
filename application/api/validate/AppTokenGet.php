<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/4
 * Time: 21:00
 */

namespace app\api\validate;


class AppTokenGet extends BaseValidate
{
    protected  $rule = [
        'username' => 'require|isEmpty',
        'password' => 'require|isEmpty',
    ];
    protected $message = [
        'username' => '用户名不能为空',
        'password' => '密码不能为空',
    ];
}