<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 9:03
 */

namespace app\lib\enum;


class ScopeEnum
{
    //权限管理
    const user = 16;
    const cms = 32;

    //后台管理
    const super = 5;
    const admin = 4;
    const storehouse = 3;
    const eworker = 2;
    const store = 1;




}