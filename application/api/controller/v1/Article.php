<?php

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Article as ArticleModel;
use app\api\validate\ArticleAdd;

class Article extends BaseController
{
    //添加或者修改文章
    public function artAdd(){
        (new ArticleAdd())->goCheck();
        $id = input('post.id');
        $title = input('post.title');
        $read_num = input('post.read_num');
        $like_num = input('post.like_num');
        $status = input('post.status');
        $content = input('post.content');
        $art = new ArticleModel();
        $imgUrl = input('post.imgUrl');

        if($id){
            $re = $art->save([
                        'title'=>$title,
                        'read_num'=>$read_num,
                        'like_num'=>$like_num,
                        'status'=>$status,
                        'content'=>htmlspecialchars($content),
                        'img_url'=>$imgUrl
                ],['id'=>$id]);
        }else{
            $re = $art->save([
                'title'=>$title,
                'read_num'=>$read_num,
                'like_num'=>$like_num,
                'status'=>$status,
                'content'=>htmlspecialchars($content),
                'img_url'=>$imgUrl
            ]);
        }
        if($re){
            return true;
        }else{
            return false;
        }
    }
    //查找全部文章
    public function artGetAll(){
        $art = new ArticleModel();
        $re = $art->select()
            ->hidden(['content','update_time','delete_time']);
        if($re){
            return [
                'status'=>true,
                'art'=>$re
            ];
        }
        return [
            'status'=>false,
            'art'=>'0'
        ];
    }
    //查找一篇文章
    public function artGetOne(){
        $id = input('id');
        $re = ArticleModel::with('comment')->find($id)->toArray();
        $re['content'] = htmlspecialchars_decode($re['content']);
        //评论内容解码
        foreach ($re['comment'] as &$v){
            $v['content'] = base64_decode($v['content']);
        }
        return $re;
    }
    //获得文章总数
    public function artGetCount(){
        $re = ArticleModel::select();
        return count($re);
    }
    //删除文章
    public function artDelete(){
        $id = input('post.id');
        $re = ArticleModel::where('id',$id)->delete();
        return $re;
    }
}