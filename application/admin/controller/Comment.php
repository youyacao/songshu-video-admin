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
        $type = input("type/i",0);
        if($type==0){
            $name = "video v";
        }else{
            $name = "text_image v";
        }
        $comments = Db("comment c")
            ->where(["c.state"=>0,"c.pid"=>0,'c.type'=>$type])
            ->join('user u', 'c.uid=u.id', 'left')
            ->join($name, 'c.vid =v.id', 'left')
            ->field([
                'c.id',
                'c.content',
                'c.uid',
                'c.type',
                'u.name name',
                'v.title',
                'c.create_time',
            ])
            ->page($page,$pageSize)
            ->order("c.create_time desc")
            ->group("c.id")
            ->select();

        $comments=$this->subComment($comments,$name,$type);
        $commmentCount = Db("comment c")
            ->where(["c.state"=>0,"c.pid"=>0,'c.type'=>$type])
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
     * @return
     * @throws DataNotFoundException
     * @throws ModelNotFoundException
     * @throws DbException
     */
    private function subComment($comments,$name,$type){

        foreach ($comments  as $key=>$item)
        {

            $subcomments = Db("comment c")
                ->where(["c.pid"=>$item['id'],"c.state"=>0])
                ->join('user u', 'c.uid=u.id', 'left')
                ->join($name, 'c.vid =v.id', 'left')
                ->field([
                    'c.id',
                    'c.content',
                    'c.uid',
                    'u.name name',
                    'v.title',
                    'c.create_time',
                ])
                ->group("c.id")
                ->order("c.create_time")
                ->select();
            if($subcomments){
                $subcomments=$this->subComment($subcomments,$name,$type);
                $comments[$key]['sub_comment']=$subcomments;
            }else{
                $comments[$key]['sub_comment']=[];
            }


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

    /**
     * Notes:更新评论内容
     * User: BigNiu
     * Date: 2019/11/25
     * Time: 10:59
     * @return Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function update()
    {
        $id = input('id');
        $content = input('content');
        $data = [
            'content' => $content,
        ];
        u_log("修改评论 {$content}({$id})成功");
        Db("comment")->where(['id' => $id])->update($data);
        return success("更新成功");
    }
}