<?php


namespace app\admin\controller;


use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\response\Json;

class Comment extends Admin
{
    /**
     * Notes:获取评论列表
     * User: BigNiu
     * Date: 2019/10/8
     * Time: 15:37
     * @return Json
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    public function getList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $comments = Db("comment c")
            ->where(["c.state"=>0,"c.pid"=>0])
            ->join('user u', 'c.uid=u.id', 'left')
            ->join('video v', 'c.vid =v.id', 'left')
            ->join('type t', 'v.type=t.id')
            ->field([
                'c.id',
                'c.content',
                'c.uid',
                'u.name name',
                'v.title',
                't.name type_name',
                'c.create_time',
            ])
            ->page($page,$pageSize)
            ->order("c.create_time desc")
            ->group("c.id")
            ->select();
        $comments=$this->subComment($comments);
        $commmentCount = Db("comment c")
            ->where(["c.state"=>0,"c.pid"=>0])
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
        if ($comments) {
            return success("获取成功", $comments,$page,$commmentCount);
        }
        return error("暂无数据");
    }

    /**
     * Notes:获取下级评论列表
     * User: BigNiu
     * Date: 2019/10/8
     * Time: 14:41
     * @param $comments
     * @param $vid
     * @return mixed
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    private function subComment($comments){

        foreach ($comments  as $key=>$item)
        {

            $subcomments = Db("comment c")
                ->where(["c.pid"=>$item['id'],"c.state"=>0])
                ->join('user u', 'c.uid=u.id', 'left')
                ->join('video v', 'c.vid =v.id', 'left')
                ->join('type t', 'v.type=t.id')
                ->field([
                    'c.id',
                    'c.content',
                    'c.uid',
                    'u.name name',
                    'v.title',
                    't.name type_name',
                    'c.create_time',
                ])
                ->group("c.id")
                ->order("c.create_time")
                ->select();
            $subcomments=$this->subComment($subcomments);
            $comments[$key]['sub_comment']=$subcomments;

        }
        return $comments;
    }

    /**
     * Notes:删除评论
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:18
     * @return Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        $ids = input('ids/a');

        u_log("删除评论(".implode($ids,',')."成功");
        Db("comment")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }

}