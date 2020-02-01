<?php

namespace app\api\controller\v1;

use app\api\validate\IDConllention;
use \app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePostivelnt;
use app\lib\exception\ThemeMissException;

class Theme
{
    /*
     * url:/theme?ids=1,2
     * 获得一组列表
     * $id是$ids=$id1,$id2,....*/
    public function getSimpleList($ids=''){
        (new IDConllention())->goCheck();
        $result = (new ThemeModel())->getSimpleByID(explode(",",$ids));
        //数据集返回数据，在database.php中定义返回类型是collection
        if($result->isEmpty()){
            throw new ThemeMissException();
        }
        return $result;

    }
    /*
     * @url=/theme/:id*/
    public function getComplexOne($id){
        (new IDMustBePostivelnt())->goCheck();
        $theme = ThemeModel::getThemeWithProduct($id);
        if(!$theme){
            throw new ThemeMissException();
        }
        return $theme;
    }

}
