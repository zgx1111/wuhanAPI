<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/22
 * Time: 15:46
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name' => 'require|isEmpty',
        'phone' => 'require|isMobile',
        'store' => 'require|isEmpty'
    ];
    protected $message = [
        'name' => '不能为空',
        'phone' => '手机号格式不正确'

    ];
}