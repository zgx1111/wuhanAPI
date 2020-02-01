<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 19:56
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WechatException;
use think\Exception;
use app\api\model\User as UserModel;
class UserToken extends Token
{
    protected $code;
    protected $wxAppid;
    protected $wxSecrret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppid = config('wx.app_id');
        $this->wxSecrret = config('wx.app_secret');
        //sptint格式化字符串
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppid,$this->wxSecrret,$this->code);
    }

    //详细的处理流程
    public function get(){
        //common中定义的连接微信的函数
        $result = curl_get($this->wxLoginUrl);

        //$result是字符串，变为数组
        $wxResult = json_decode($result,true);

        //判断是否为空，为空就是微信返回错误
        if(empty($wxResult)){
            throw new Exception("openid获取失败，微信返回错误");
        }else{

            //如果结果中存在errcode，则也是错误结果
            $error = array_key_exists('errcode',$wxResult);
            if($error){

                //抛出异常
                $this->processLoginError($wxResult);
            }else{

                //授权
                return $this->grantToken($wxResult);
            }
        }
    }
    //返回Token
    public function grantToken($wxResult){
        //拿到Appid
        //数据库查看是否存在oppenid，存在就不处理，不存在需要存储
        //生成令牌，缓存数据
        //把令牌返回到客户端
        //key:令牌
        //value:wxResult,uid,scope(用户级别权限)
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenID($openid);
        if($user){
            $uid = $user->id;
        }
        else{
            $uid = $this->newUser($openid);
        }
        //封装信息
        $cacheValue = $this->CacheValue($wxResult,$uid);
        //缓存返回token
        $token = $this->saveCacheValue($cacheValue);
        return $token;


    }
    //保存缓存
    private function saveCacheValue($CacheValue){
        //随机生成key
        $key = self::generateToken();
        //数组转字符串
        $value = json_encode($CacheValue);
        //缓存时间
        $expire_in = config('setting.token_expire_in');

        //tp5默认的缓存
        $request = cache($key,$value,$expire_in);
        if(!$request){
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errorcode'=>10005
            ]);
        }
        return $key;
    }
    //封装数据
    private function CacheValue($wxResult,$uid){
        $cacheValue=$wxResult;
        $cacheValue['uid']=$uid;
        //调用scope枚举类
        $cacheValue['scope']=ScopeEnum::user;
        return $cacheValue;
    }
    //创建新用户
    private function newUser($openid){
        $user = UserModel::create([
            'openid'=>$openid
        ]);
        return $user->id;
    }

    //wx抛出错误函数
    public function processLoginError($wxResult){
        throw new WechatException([
            'msg'=>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode'],
        ]);
    }
}