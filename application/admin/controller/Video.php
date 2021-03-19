<?php


namespace app\admin\controller;


use think\Exception;
use think\response\Json;

class Video extends Admin
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
        $state = input('state/i');
        if($state!=null){
            $where['state'] = $state;
        }
        $videoList = Db("video v")
            ->join('user u','v.uid = u.id','left')
            ->join('type t','v.type = t.id','left')
            ->join('type t1','t1.id = t.pid','left')
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
                'v.is_subject',
                'v.need_gold',
                'v.skr_count',
                'v.state',
                'u.name',
                't.name type_name',
                't1.name ptype_name',
                't1.id pid',
            ])
            ->order("v.id desc")
            ->select();

        $count = Db("video")
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
    public function deleteVideo(){
        $ids = input('ids/a');
        Db("video")->whereIn('id', $ids)->delete();
        u_log("删除视频(".implode($ids,',')."成功");
        return success("删除成功");
    }

    /**
     * Notes:添加视频
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:23
     * @return Json
     * @throws Exception
     * @throws \think\exception\PDOException
     */
    public function addVideo()
    {
        $uid = input("uid/i",1);
        $title = input("title");//标题
        $url = input("url");//视频链接
        $type = input("type");//视频类型
        $img = input('img');//通过视频存储路径获取视略缩图"1.png";//
        $need_gold = intval(input('need_gold'));
        $skr_count = intval(input('skr_count'));
        $user = Db("user")->where(['id'=>$uid])->find();
        if(!$user){
            return error("该用户不存在，请重新选择");
        }

        $typeInfo = Db("type")->where(['id' => $type, "level" => 2])->find();
        if (!$typeInfo) {
            u_log("用户" . $user['name'] . "(" . $user['id'] . ")发布视频失败('类型选择错误')", "error");
            return error("类型选择错误");
        }
        $data = [
            "title" => $title,
            "uid" => $user['id'],
            "type" => $type,//视频分类
            "img" => $img,
            "url" => $url,
            'need_gold' => $need_gold,
            'skr_count' => $skr_count,
            "state" => 1,
            "create_time" => TIME
        ];
        $id = Db("video")->insertGetId($data);
        $data['id'] = $id;
        u_log("用户" . $user['name'] . "(" . $user['id'] . ")发布视频成功");
        return success("成功", $data);
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
    public function updateVideo(){
        $id = input('id');
        $title = input('title');
        $uid = input('uid');
        $type = input("type");//视频类型
        $url = input('url');
        $img = input('img');
        $need_gold = intval(input('need_gold'));
        $skr_count = intval(input('skr_count'));
        $state = input('state');
        $data = [
            'title' => $title,
            'uid' => $uid,
            "type" => $type,
            'url' => $url,
            'img' => $img,
            'need_gold' => $need_gold,
            'skr_count' => $skr_count,
            'state' => $state,
        ];
        Db("video")->where(['id' => $id])->update($data);
        u_log("修改视频 {$title}({$id})成功");
        return success("更新成功");
    }
}