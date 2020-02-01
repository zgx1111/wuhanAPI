<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/18
 * Time: 20:34
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = [
        'count' => 'isPostiveInteger|between:1,15'
    ];
    protected $message = [
        'count' => '必须是正整数，并且在1到15中间'
    ];

}