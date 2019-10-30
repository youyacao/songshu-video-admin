<?php


namespace app\admin\controller;


class Comment extends Admin
{
    public function getList()
    {
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $where = [];
        $name = input('name');
        if ($name) {
            $where = [
                'name' => ['like', "%{$name}%"],
                'custom_id' => ['like', "%{$name}%"],
                'phone' => ['like', "%{$name}%"]
            ];
        }
        $commment = Db("comment c")
            ->join('user u', 'c.uid=u.id', 'left')
            ->join('video v', 'c.vid =v.id', 'left')
            ->join('type t', 'v.type=t.id')
            ->field(
                [
                    'c.id',
                    'c.content',
                    'c.uid',
                    'u.name name',
                    'v.title',
                    't.name type_name',
                    'c.create_time',
                ]
            )
            ->order('create_time desc')
            ->page($page, $pageSize)
            ->select();
        $commmentCount = Db("comment c")
            ->join('user u', 'c.uid=u.id', 'left')
            ->join('video v', 'c.vid =v.id', 'left')
            ->join('type t', 'v.type=t.id')
            ->field(
                [
                    'c.id',
                    'c.content',
                    'c.uid',
                    'u.name name',
                    'v.title',
                    't.name type_name',
                    'c.create_time',
                ]
            )
            ->count();
        if ($commment) {
            return success("获取成功", $commment,$page,$commmentCount);
        }
        return error("暂无数据");
    }

    public function del()
    {
        $ids = input('ids/a');

        u_log("删除评论(".implode($ids,',')."成功");
        Db("comment")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }

}