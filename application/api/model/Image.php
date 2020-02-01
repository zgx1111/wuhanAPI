<?php

namespace app\api\model;

use think\Model;
class Image extends BaseModel
{
    //
//    use SoftDelete;
    //开启自动写入时间戳
//    protected $autoWriteTimestamp = true;
    protected $autoWriteTimestamp = true;
    protected $hidden = ['id',  'delete_time', 'update_time'];
    //获取器获取数据并处理，最后返回客户端
    public function getUrlAttr($value,$data){
        return $this->getUrl($value,$data);
    }

}
