<?php
/**
 * Created by PhpStorm.
 * User: bigniu
 * Date: 2019-12-17
 * Time: 16:02:07
 */

namespace app\admin\controller;

/**
 * TODO 待注释
 * Class Order
 * @package app\admin\controller
 */
class Order extends Admin
{
    public function getList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $where = [];
        $order_num = input('order_num');
        $state = input('state/i');
        if($state){
            $where = [
                'state' => $state,
            ];
        }
        if ($order_num) {
            $where = [
                'order_num' => $order_num,
            ];
        }
        $orderList = Db("order o")
            ->where($where)
            ->join('pay_type p',"o.pid=p.id","left")
            ->join('vip_shop v','o.vid=v.id','left')
            ->join("user u","o.uid=u.id",'left')
            ->field([
                'o.id',
                'o.order_num',
                'o.state',
                'o.create_time',
                'o.notify_time',
                'o.ip',
                'p.name',
                'v.title',
                'v.price',
                'u.name'
            ])
            ->order('create_time desc')->page($page, $pageSize)->select();
        $count = Db("order")->whereOr($where)->count();
        return success("获取成功", $orderList, $page, $count);
    }
}