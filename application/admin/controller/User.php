<?php


namespace app\admin\controller;


class User extends Admin
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
        $userList = Db("user")->whereOr($where)->page($page, $pageSize)->select();

        $count = Db("user")->whereOr($where)->count();
        return success("获取成功", $userList, $page, $count);
    }

    public function deleteUser()
    {
        $ids = input('ids/a');
        u_log("删除用户({$ids})成功");
        Db("user")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }

    public function updateUser()
    {
        $id = input('id');
        $name = input('name');
        $custom_id = input('custom_id');
        $phone = input('phone');
        $head_img = input('head_img');
        $qq = input('qq');
        $mail = input('mail');
        $data = [
            'name' => $name,
            'custom_id' => $custom_id,
            'phone' => $phone,
            'head_img' => $head_img,
            'qq' => $qq,
            'mail' => $mail,
        ];
        u_log("修改用户 {$name}({$id})成功");
        Db("user")->where(['id' => $id])->update($data);
        return success("更新成功");
    }

    public function userLog()
    {
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $userLog = Db("user_log")->page($page, 10)->select();
        return success($userLog);
    }
}