<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/10
 * Time: 21:46
 */

namespace app\api\validate;

class IDMustBePostivelnt extends BaseValidate
{
    protected $rule=[
        'id' => 'require|isPostiveInteger',
        //'num' => 'in:1,2,3'
    ];

    protected $message=[
        'id'=>'参数必须是正整数'
    ];

}