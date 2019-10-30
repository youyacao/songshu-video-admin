<?php


namespace app\admin\controller;


class Login
{
    public function login(){
        $username = input("username");
        $password = input("password");
        $admin = Db("admin")->where(['username'=>$username])->find();
        if(!$admin){
            u_log("管理员{$username}登录失败",'error');
            return error("用户名或密码错误");
        }
        if($admin['password']!=adminpass($password)){
            u_log("管理员{$username}登录失败",'error');
            return error("用户名或密码错误");
        }
        Db("admin")->where(['username'=>$username])->update(['ip'=>getIp(),'last_time'=>TIME]);
        session('admin',$admin);
        unset($admin['password']);
        u_log("管理员{$username}登录成功",'login');
        return success("登录成功",$admin);
    }
    public function addUser(){
        $username = input('username','admin');
        $password = input('password','admin');
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
    public function isLogin(){
        $admin = session("admin");
        if($admin){
            return success("已登录");
        }
        return error("未登录");
    }
    public function logout(){
        $admin = session("admin");
        if($admin){
            u_log("管理员{$admin['username']}退出登录",'logout');
        }
        session('admin',null);

        return success("退出成功");
    }
}