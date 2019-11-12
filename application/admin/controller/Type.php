<?php


namespace app\admin\controller;

/**
 * Class Type 分类相关
 * @package app\admin\controller
 */
class Type extends Admin
{
    /**
     * Notes:获取分类列表
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:20
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList(){

        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $type1 = Db("type")->where(["level"=>1,"enable"=>1])->page($page, $pageSize)->select();
        $count = Db("type")->where(["level"=>1,"enable"=>1])->count();
        foreach ($type1 as $key=>$item)
        {
            $type2 = Db("type")->where(["pid"=>$item['id'],"enable"=>1])->select();
            $type1[$key]['sub_type']=$type2?$type2:[];
        }
        return success("成功",$type1,$page,$count);
    }

    /**
     * Notes:添加分类
     * @param pid 上级分类ID
     * @param name 分类名称
     * @param icon 分类图标
     * User: BigNiu
     * Date: 2019/10/30
     * Time: 13:23
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function addType(){
        $pid = input("pid/i",1);
        $level = 1;
        //上级ID不为0
        if($pid>1){
            $pType = Db("type")->where(['id'=>$pid])->find();
            //判断上级是否存在
            if(!$pType){
                return error("上级不存在");
            }
            //当前等级为上级+1
            $level = $pType['level']+1;
        }
        $name = input("name");//分类名称
        $icon = input("icon");//分类图标
        if(!$name||!$icon){
            return error("分类名称和图标不能为空");
        }
        $data = [
            'pid'=>$pid,
            'level'=>$level,
            'name'=>$name,
            'icon'=>$icon,
            "enable"=>1,
            "create_time"=>date("Y-m-d H:i:s",time()),
            "sort_id"=>999
        ];
        $res = Db("type")->insert($data);
        if($res){
            return success("添加成功");
        }
        return error("添加失败");

    }

    /**
     * Notes:更新分类信息
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:20
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function updateType(){
        $id = input("id/i");//分类ID
        $name = input("name");//分类名称
        $icon = input("icon");//分类图标
        $pid = input("pid");//上级ID
        $sort_id = input("sort_id");//上级ID
        $pType = Db("type")->where(['id'=>$pid])->find();
        if($pid!=1&&!$pType){
            return error("上级分类不存在");
        }
        if($id==$pid){
            return error("上级ID不能为当前分类ID");
        }
        //判断是否有下级，有下级就是一级分类
        $type = Db("type")->where(['pid'=>$id])->select();

        if($type&&$pid!=1){
            return error("下级已有分类，请先删除后修改");
        }
        $data = [
            'pid'=>$pid,
            'level'=>$pType['level']+1,
            'name'=>$name,
            'icon'=>$icon,
            'sort_id'=>$sort_id
        ];
        Db("type")->where(['id'=>$id])->update($data);
        return success("修改成功");
    }

    /**
     * Notes:删除分类
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:20
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delete(){
        $ids = input('ids/a');
        Db("type")->whereIn('id', $ids)->delete();
        u_log("删除分类(".implode($ids,',')."成功");
        return success("删除成功");
    }

}