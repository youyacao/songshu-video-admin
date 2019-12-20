<?php
/**
 * Created by PhpStorm.
 * User: bigniu
 * Date: 2019-12-17
 * Time: 15:31:24
 */

namespace app\admin\controller;

/**
 * TODO 待注释
 * Class PayType
 * @package app\admin\controller
 */
class PayType extends Admin
{
    public function getList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $list = Db("pay_type")->page($page, $pageSize)->select();
        $count = Db("pay_type")->count();
        return success("获取成功", $list, $page, $count);
    }
    public function delete(){
        $ids = input('ids/a');
        u_log("删除支付类型(".implode($ids,',')."成功");
        Db("pay_type")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }
    public function add(){
        $name = input("name");
        $icon =input("icon");
        $type = input("type");
        $fname = input('fname');
        $data = [
            'name'=>$name,
            'icon'=>$icon,
            'type'=>$type,
            'fname'=>$fname,
            'state'=>1,
            'create_time'=>TIME
        ];
        $res = Db("pay_type")->insert($data);
        if($res){
            return success("添加成功");
        }
        return error("添加失败");
    }
    public function update(){
        $id = input("id/i");
        $name = input("name");
        $icon =input("icon");
        $type = input("type");
        $fname = input('fname');
        $data = [
            'name'=>$name,
            'icon'=>$icon,
            'type'=>$type,
            'fname'=>$fname,
        ];
        $res = Db("pay_type")->where(['id'=>$id])->update($data);
        if($res){
            return success("修改成功");
        }
        return error("修改失败");
    }
}