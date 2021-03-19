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
 * Class Cipher
 * @package app\admin\controller
 */
class Cipher extends Admin
{
  public function getList(){
      $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
      $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
      $list = Db("cipher")->page($page, $pageSize)->select();
      $count = Db("cipher")->count();
      return success("获取成功", $list, $page, $count);
  }
  public function add(){
      $admin = session("admin");
      $num = input("num");
      $amount = input("amount");
      $over_time = input("over_time");

      if (empty($num)) {
          return error('卡密数量不能为空');
      }
      if (empty($amount)) {
          return error('兑换额度不能为空');
      }

      $data = [
          'user_id'=>$admin['id'],
          'amount'=>$amount,
          'over_time'=>strtotime($over_time),
          'status'=>1,
          'updated_at'=>time(),
          'created_at'=>time()
      ];

      $datas = [];
      for ($i = 1; $i <= $num; $i++) {
          $code = 'KM' . getRandNumber(0, 9, 9) . createRefcode();
          $data['code'] = strtoupper(md5($code));
          $datas[] = $data;
      }

      $res = Db("cipher")->insertAll($datas);
      if($res){
          return success("添加成功");
      }
      return error("添加失败");
  }

  public function delete(){
      $ids = input('ids/a');
      u_log("删除卡密(".implode($ids,',')."成功");
      Db("cipher")->whereIn('id', $ids)->delete();
      return success("删除成功");
  }
}