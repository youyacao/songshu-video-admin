<?php


namespace app\admin\controller;


class Login
{
    public function login(){
        $username = input("username");
        $password = input("password");
        $admin = Db("admin")->where(['username'=>$username])->find();
        if(!$admin){
            u_log("管理员{username}登录失败",'error');
            return error("用户名或密码错误");
        }
        if($admin['password']!=adminpass($password)){
            u_log("管理员{username}登录失败",'error');
            return error("用户名或密码错误");
        }
        Db("admin")->where(['username'=>$username])->update(['ip'=>getIp(),'last_time'=>TIME]);
        session('admin',$admin);
        unset($admin['password']);
        u_log("管理员{username}登录成功",'login');
        return success("登录成功",$admin);
    }
    public function logout(){
        $admin = session("admin");
        if($admin){
            u_log("管理员${$admin['username']}退出登录",'logout');
        }
        session('admin',null);

        return success("退出成功");
    }
}