<?php

namespace app\api\validate;

class ArticleAdd extends BaseValidate
{
    protected  $rule = [
        'title' => 'require',
        'content' => 'require',
        'like_num' => 'require',
        'status' => 'require',
        'read_num' => 'require'
    ];
}