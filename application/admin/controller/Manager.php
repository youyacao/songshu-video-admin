<?php


namespace app\admin\controller;


class Manager extends Admin
{
    public function getList(){
        $adminList = Db("admin")->field(['id','username','ip','create_time','last_time'])->select();
        return success("获取成功",$adminList);
    }
    public function addUser(){
        $username = input('username');
        $password = input('password');
        if(!$username||!$password){
            return error("请输入用户名或密码");
        }
        $admin = Db("admin")->where(['username'=>$username])->find();
        if($admin)
        {
            u_log("添加管理员{$username}失败，用户已存在",'error');
            return error("该用户已存在");
        }

        $insert =Db("admin")->insert(['username'=>$username,'password'=>adminpass($password),'create_time'=>TIME]);
        if($insert){
            u_log("添加管理员{$username}成功");
            return success("添加成功");
        }
        u_log("添加管理员{$username}失败",'error');
        return error("添加失败");
    }
    public function updateUser(){
        $username = input('username');
        $password = input('password');
        $res = Db("admin")->where(['username'=>$username])->update(['password'=>adminpass($password)]);
        if($res){
            u_log("修改管理员{$username}密码成功");
            return success("修改成功");
        }
        u_log("修改管理员{$username}密码失败","error");
        return error("修改失败");
    }
    public function deleteUser()
    {
        $admin = session("admin");
        $uid = input("id");
        if($admin['id']==$uid){
            return error("不能删除当前用户");
        }
        $res = Db("admin")->where(['id'=>$uid])->delete();
        if($res){
            u_log("删除管理员({$uid})成功");
            return success("删除成功");
        }
        u_log("删除管理员({$uid})失败",'error');
        return error("删除失败");
    }
    public function log(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $logList = Db("admin_log")->order('time desc')->page($page, $pageSize)->select();
        $count = Db("admin_log")->count();
        return success("获取成功", $logList, $page, $count);
    }
}