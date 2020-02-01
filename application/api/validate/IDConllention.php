<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17
 * Time: 22:52
 */

namespace app\api\validate;


class IDConllention extends BaseValidate
{
    protected $rule = [
        'ids' => 'require|checkID'
    ];
    protected $message=[
        'ids' => '参数必须是以逗号分割的多个正整数'
    ];
    protected function checkID($value){
        $ids = explode(',',$value);
        if(empty($ids)){
            return false;
        }
        foreach($ids as $id){
            if(!$this->isPostiveInteger($id)){
                return false;
            }
        }
        return true;
    }
}