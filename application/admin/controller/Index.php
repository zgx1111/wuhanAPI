<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/18
 * Time: 20:36
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{
    public function index(){
        echo $this->fetch();
    }
    public function welcome(){
        return view();
    }

}