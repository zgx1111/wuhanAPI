<?php
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Comment as CommentModel;
use app\api\service\Token as TokenService;

class Comment extends BaseController{

    //添加评论
    public function commentAdd(){
        //获得用户id
        $uid = TokenService::getCurrentUid();
        //获得文章id
        $id = input('post.id');
        //获得评论内容
        $content = input('post.content');
         //对评论内容进行编码
        $content = $this->transcoding($content);
        //增加评论
        $com = new CommentModel();
        $re = $com->save([
            'user_id'=>$uid,
            'article_id'=>$id,
            'content'=>$content
        ]);
        if($re){
            return [
                'status'=>true
            ];
        }
        return [
            'status'=>false
        ];
    }
     //对内容字符串进行转码处理
    public function transcoding($str){
        if (!$str) {
            return $str;
        }
        $str = base64_encode($str);
        return $str;
    }
}