<?php


namespace app\admin\controller;

use think\Db;


class User extends Admin
{
    /**
     * Notes:获取用户列表
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:22
     * @return \think\response\Json
     * @throws \think\Exception
     */
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
        $userList = Db("user")->whereOr($where)->order('create_time desc')->page($page, $pageSize)->select();
        foreach ($userList as $key=>$row){
            if($row['parent_id']){
                $user = Db('user')->where('id',$row['parent_id'])->value('name');
                $row['parent_name'] = $user ? $user : '已删除';
            }
            $row['money'] = number_format($row['money'],2);
            $userList[$key] = $row;
        }

        $count = Db("user")->whereOr($where)->count();
        return success("获取成功", $userList, $page, $count);
    }

    /**
     * 获取邀请推广列表
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getInviteList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $where = [];
        $name = input('name');
        if ($name) {
            $where = [
                'u.name' => ['like', "%{$name}%"],
                'u.custom_id' => ['like', "%{$name}%"],
                'u.phone' => ['like', "%{$name}%"]
            ];
        }
        $inviteList = Db("invite")->alias("i")->join('__USER__ u','i.user_id=u.id')->whereOr($where)->field('i.*,u.name')->order('i.id desc')->page($page, $pageSize)->select();
        foreach ($inviteList as $key=>$row){
            $user = Db('user')->where('id',$row['invite_uid'])->value('name');
            $row['invite_name'] = $user ? $user : '已删除';
            $inviteList[$key] = $row;
        }

        $count = Db("invite")->alias("i")->join('__USER__ u','i.user_id=u.id')->whereOr($where)->count();
        return success("获取成功", $inviteList, $page, $count);
    }

    /**
     * 获取账变记录列表
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getChangeList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $where = [];
        $name = input('name');
        if ($name) {
            $where = [
                'u.name' => ['like', "%{$name}%"],
                'u.custom_id' => ['like', "%{$name}%"],
                'u.phone' => ['like', "%{$name}%"]
            ];
        }
        $list = Db("account_change")->alias("a")->join('__USER__ u','a.user_id=u.id')->whereOr($where)->field('a.*,u.name')->order('a.id desc')->page($page, $pageSize)->select();
        $count = Db("account_change")->alias("a")->join('__USER__ u','a.user_id=u.id')->whereOr($where)->count();
        return success("获取成功", $list, $page, $count);
    }

    /**
     * 获取提现记录列表
     *
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getWithdrawList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $where = [];
        $name = input('name');
        if ($name) {
            $where = [
                'u.name' => ['like', "%{$name}%"],
                'u.custom_id' => ['like', "%{$name}%"],
                'u.phone' => ['like', "%{$name}%"]
            ];
        }
        $list = Db("withdraw")->alias("a")->join('__USER__ u','a.user_id=u.id')->whereOr($where)->field('a.*,u.name AS uname')->order('a.id desc')->page($page, $pageSize)->select();
        $count = Db("withdraw")->alias("a")->join('__USER__ u','a.user_id=u.id')->whereOr($where)->count();
        $gold_rate = intval(Db("config")->where('name','gold_rate')->value('value'));
        foreach($list as $key=>$item){
            $item['money'] = $gold_rate>0 ? number_format($item['num']/$gold_rate,2) : '未设置费率';
            $list[$key] = $item;
        }
        return success("获取成功", $list, $page, $count);
    }

    public function postWithdraw(){
        $id = input('id/i');
        $withdraw = Db('withdraw')->where('id',$id)->find();
        if(!$withdraw){
            return error('未找到相应数据');
        }
        if($withdraw['status'] != 0){
            return error('此提现记录不可操作');
        }
        if(input('type') == 1){
            if(Db('withdraw')->where('id',$withdraw['id'])->update(['status'=>1,'updated_at'=>date('Y-m-d H:i:s')])){
                return success('提现成功');
            }else{
                return success('提现失败');
            }
        }elseif(input('type') == 2) {
            $remark = input('remark','不可提现');
            $user = Db('user')->where('id',$withdraw['user_id'])->find();
            if(!$user){
                Db('withdraw')->where('id',$withdraw['id'])->update(['status'=>2,'remark'=>'用户已删除','updated_at'=>date('Y-m-d H:i:s')]);
                return error('该用户已删除，已直接拒绝');
            }
            $money = $withdraw['num'];
            // 启动事务
            Db::startTrans();
            try{
                //退回金币
                $allMoney = $user['money'] + $money;

                if(!Db('user')->where('id',$user['id'])->update(['money'=>$allMoney])){
                    Db::rollback();
                    return error('提现出错，请稍候再试');
                }

                //添加账变记灵
                $data = array();
                $data['user_id'] = $user['id'];
                $data['num'] = $money;
                $data['before_money'] = $user['money'];
                $data['after_money'] = $allMoney;
                $data['info'] = '提现失败退回';
                $data['data_id'] = $withdraw['id'];
                $data['data_type'] = 'withdraw';
                $data['created_at'] = date('Y-m-d H:i:s');
                Db('account_change')->insert($data);

                if(!Db('withdraw')->where('id',$withdraw['id'])->update(['status'=>2,'remark'=>$remark,'updated_at'=>date('Y-m-d H:i:s')])){
                    // 回滚事务
                    Db::rollback();

                    return error('拒绝失败');
                }

                // 提交事务
                Db::commit();
                return success('拒绝成功');
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
            }
        }
        return error('操作错误');
    }

    /**
     * Notes:删除用户
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:22
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function deleteUser()
    {
        $ids = input('ids/a');
        u_log("删除用户(".implode($ids,',')."成功");
        Db("user")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }

    /**
     * Notes:给一个用户生成邀请码
     * User: JackXie
     * Date: 2020/02/22
     * Time: 18:06
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function invite(){
        $id = input('id/i');
        $user = Db('user')->where('id',$id)->find();
        if(!$user){
            return error('未找到该用户');
        }
        if(Db('user')->where('id',$id)->update(['invit_code'=>$this->getInvite()])){
            return success('邀请码生成成功');
        }
        return error('邀请码生成失败');
    }

    /**
     * Notes:生成一个邀请码
     * User: JackXie
     * Date: 2020/02/22
     * Time: 18:12
     * @return String
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    private function getInvite(){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for($i=0;$i<6;$i++){
            $code .= $str[rand(0,strlen($str)-1)];
        }
        if(Db('user')->where('invit_code',$code)->find()){
            return $this->getInvite();
        }
        return $code;
    }

    /**
     * Notes:更新用户信息
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:22
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function updateUser()
    {
        $id = input('id');
        $name = input('name');
        $custom_id = input('custom_id');
        $phone = input('phone');
        $vip_end = input('vip_end');
        $head_img = input('head_img');
        $qq = input('qq');
        $mail = input('mail');
        $disable = input('disable');
        $disable_time = input('disable_time');
        $data = [
            'name' => $name,
            'custom_id' => $custom_id,
            'phone' => $phone,
            'head_img' => $head_img,
            'qq' => $qq,
            'mail' => $mail,
            'vip_end' => $vip_end,
            'disable' => $disable,
            'disable_time' => $disable_time,
        ];
        u_log("修改用户 {$name}({$id})成功");
        Db("user")->where(['id' => $id])->update($data);
        return success("更新成功");
    }

    /**
     * Notes:用户日志记录
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:22
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function userLog()
    {
        $where = [];
        if ('login' == input('type')) {
            $where = ['type' => 'login'];
        }
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $userLog = Db("user_log")->where($where)->order('time desc')->page($page, 10)->select();
        $userLogCount = Db("user_log")->where($where)->count();
        return success("获取成功", $userLog,$page,$userLogCount);
    }
}