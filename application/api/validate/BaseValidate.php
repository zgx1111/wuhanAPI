<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 13:49
 */

namespace app\api\validate;


use app\lib\exception\ProductException;
use think\captcha\Captcha;
use think\Exception;
use think\Request;
use think\Validate;
use app\lib\exception\ParameterException;
class BaseValidate extends Validate
{
    ///获取传过来的所有参数，check方法检验参数是否合格
    public function goCheck(){
        $request = Request::instance();
        $param = $request->param();
        $result= $this->batch()->check($param);
        if(!$result){
            $e=new ParameterException([
                'msg'=>$this->error
            ]);
            throw $e;
        }else{
            return true;
        }
    }
    //自定义判断是否为正整数
    protected function isPostiveInteger($value,$rule='',$data = '',$field=''){
        if(is_numeric($value) && is_int($value+0) && ($value + 0) > 0){
            return true;
        }else{
            return false;
        }
    }
    //自定义判断是否为空
    protected function isEmpty($value,$rule='',$data = '',$field=''){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }
    //自定义判断手机号
    public function isMobile($value){
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if($result){
            return true;
        }else{
            return false;
        }
    }


    //过滤参数，获取指定rule中的变量值
    public function getDataByValue($arrays)
    {
        //判断传入的参数中是否含有意图覆盖uid的非法数据，因为uid都是直接从缓存中读取的；
        if(array_key_exists('user_id',$arrays)|array_key_exists('uid',$arrays)){
            throw new ProductException([
                'msg' => '参数中包含非法的参数名user_id和uid'
            ]);
        }
        $newArray=[];

        foreach($this->rule as $key=>$value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;

    }
    //自定义判断验证码
    public function isCode($value){
        $captcha = new Captcha();
        $result=$captcha->check($value);
        if($result){
            return true;
        }else{
            return false;
        }
    }
}