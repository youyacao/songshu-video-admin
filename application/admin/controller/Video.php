<?php


namespace app\admin\controller;


class Video extends Admin
{
    public function getList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $whereOr = [];
        $where = [];
        $name = input('name');
        if ($name) {
            $whereOr = [
                'title' => ['like', "%{$name}%"]
            ];
        }
        $type = input('type/i');
        if($type){
            $where['type'] = $type;
        }
        $uid = input('uid/i');
        if($uid){
            $where['uid'] = $uid;
        }
        $videoList = Db("video v")
            ->join('user u','v.uid = u.id','left')
            ->join('type t','v.type = t.id','left')
            ->whereOr($whereOr)
            ->where($where)
            ->page($page, $pageSize)
            ->field([
                'v.id',
                'v.uid',
                'v.title',
                'v.url',
                'v.img',
                'v.create_time',
                'v.type',
                'u.name',
                't.name type_name',
            ])
            ->order("create_time desc")
            ->select();

        $count = Db("video")
            ->whereOr($whereOr)
            ->where($where)
            ->count();
        return success("获取成功", $videoList, $page, $count);
    }
    public function deleteVideo(){
        $ids = input('ids/a');
        Db("video")->whereIn('id', $ids)->delete();
        u_log("删除视频 ({$ids})成功");
        return success("删除成功");
    }
    public function updateVideo(){
        $id = input('id');
        $title = input('title');
        $uid = input('uid');
        $url = input('url');
        $img = input('img');
        $data = [
            'title' => $title,
            'uid' => $uid,
            'url' => $url,
            'img' => $img,
        ];
        Db("video")->where(['id' => $id])->update($data);
        u_log("修改视频 {$title}({$id})成功");
        return success("更新成功");
    }
}