<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 20:25
 */

namespace app\lib\exception;


use think\Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(\Exception $e)
    {

        //如果是自定义异常
        if($e instanceof BaseException){
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            //设置开关，是否显示错误信息
            //再生产模式下，关闭debug调试
            if(config('app_debug')){
                return parent::render($e);
            }else{
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }

        }
        //获取请求的url
        $request = Request::instance();

        $result=[
            'msg' => $this->msg,
            'errorCode' => $this->errorCode,
            'request_url' => $request->url(),
            //'code'=>$e->getMessage()
        ];
        //返回json的自定义异常信息
        return json($result,$this->code);
    }

    //将服务器错误记录到日志
    public function recordErrorLog(\Exception $e){
        Log::init([
            'type'=>'File',
            'path'=>LOG_PATH,
            'level'=>['error']
        ]);
        Log::record($e->getMessage(),'error');
    }

}