<?php


namespace app\admin\controller;


use think\Exception;
use think\response\Json;

class TextImage extends Admin
{
    /**
     * Notes:获取视频列表
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:22
     * @return Json
     * @throws Exception
     */
    public function getList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $whereOr = [];
        $where = [];
        $name = input('name');
        if ($name) {
            $whereOr = [
                'title' => ['like', "%{$name}%"],
                'content' => ['like', "%{$name}%"],
            ];
        }
        $type = input('type/i');
        if($type!=null){
            $where['type'] = $type;
        }
        $uid = input('uid/i');
        if($uid){
            $where['uid'] = $uid;
        }
        $state = input('state/i');
        if($state!=null){
            $where['state'] = $state;
        }
        $videoList = Db("text_image t")
            ->join('user u','t.uid = u.id','left')
            ->whereOr($whereOr)
            ->where($where)
            ->page($page, $pageSize)
            ->field([
                't.id',
                't.uid',
                't.title',
                't.content',
                't.images',
                't.create_time',
                't.type',
                't.state',
                'u.name',
            ])
            ->order("create_time desc")
            ->select();

        $count = Db("text_image")
            ->whereOr($whereOr)
            ->where($where)
            ->count();
        return success("获取成功", $videoList, $page, $count);
    }

    /**
     * Notes:删除视频
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:23
     * @return Json
     * @throws Exception
     * @throws \think\exception\PDOException
     */
    public function delete(){
        $ids = input('ids/a');
        Db("text_image")->whereIn('id', $ids)->delete();
        u_log("删除图文(".implode($ids,',')."成功");
        return success("删除成功");
    }

    /**
     * Notes:更新视频
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:23
     * @return Json
     * @throws Exception
     * @throws \think\exception\PDOException
     */
    public function update(){
        $id = input('id');
        $title = input('title');
        $content = input('content');
        $uid = input('uid');
        $img = input('images');
        $state = input('state');
        $data = [
            'title' => $title,
            'content' => $content,
            'uid' => $uid,
            'images' => $img,
            'state' => $state,
        ];
        Db("text_image")->where(['id' => $id])->update($data);
        u_log("修改图文 {$title}({$id})成功");
        return success("更新成功");
    }
}