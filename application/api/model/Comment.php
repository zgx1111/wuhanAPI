<?php

namespace app\api\model;

class Comment extends BaseModel{
    protected $autoWriteTimestamp = true;
    protected $hidden = ['update_time','delete_time'];
}