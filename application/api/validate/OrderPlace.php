<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 13:49
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;


//
class OrderPlace extends BaseValidate
{
    //products传过来的参数是二维数组形式
    /*protected $product=[
        [
            'product_id'=>1,
            'count' =>3
        ],
        []
    ];*/
    protected $rule = [
        'products'=>'checkProducts'
    ];
    //数组子元素检验规则
    protected $singleRule = [
        'product_id'=>'require|isPostiveInteger',
        'count'=>'require|isPostiveInteger'
    ];
    //检验函数
    protected function checkProducts($values){
        if(!is_array($values)){
            throw new ParameterException([
                'msg' => '商品参数不是数组'
            ]);
        }
        if(empty($values)){
            throw new ParameterException([
                'msg'=>'商品参数不存在'
            ]);
        }
        foreach($values as $value){
            $this->checkProduct($value);
        }
        return true;
    }

    //检查数组子元素
    public function checkProduct($value){
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg'=>'商品参数数组子参数错误'
            ]);
        }
    }

}