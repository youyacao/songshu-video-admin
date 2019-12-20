<?php
/**
 * Created by PhpStorm.
 * User: bigniu
 * Date: 2019-12-17
 * Time: 15:30:59
 */

namespace app\admin\controller;


use think\Controller;

/**
 * TODO 待注释
 * Class VipShop
 * @package app\admin\controller
 */
class VipShop extends Admin
{
  public function getList(){
      $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
      $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
      $list = Db("vip_shop")->page($page, $pageSize)->select();
      $count = Db("vip_shop")->count();
      return success("获取成功", $list, $page, $count);
  }
  public function add(){
      $title = input("title");
      $price = input("price");
      $state = input("state/i");
      $desc = input("desc");
      $time = input('time');
      $data = [
          'title'=>$title,
          'price'=>$price,
          'state'=>$state,
          'desc'=>$desc,
          'state'=>1,
          'time'=>$time,
          'create_time'=>TIME
      ];
      $res = Db("vip_shop")->insert($data);
      if($res){
          return success("添加成功");
      }
      return error("添加失败");
  }
  public function delete(){
      $ids = input('ids/a');
      u_log("删除VIP商品(".implode($ids,',')."成功");
      Db("vip_shop")->whereIn('id', $ids)->delete();
      return success("删除成功");
  }
  public function update(){
      $id = input("id/i");
      $title = input("title");
      $price = input("price");
      $state = input("state/i");
      $desc = input("desc");
      $time = input('time');
      $data = [
          'title'=>$title,
          'price'=>$price,
          'state'=>$state,
          'desc'=>$desc,
          'time'=>$time
      ];
      $res = Db("vip_shop")->where(['id'=>$id])->update($data);
      if($res){
          return success("修改成功");
      }
      return error("修改失败");
  }
}