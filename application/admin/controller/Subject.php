<?php


namespace app\admin\controller;


use think\Exception;
use think\response\Json;

class Subject extends Admin
{
    /**
     * Notes:获取列表
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:22
     * @return Json
     * @throws Exception
     */
    public function getList(){
        $vid = intval(input('vid'));
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $where = [];
        if($vid){
            $where['vid'] = $vid;
        }
        $list = Db("video_subject")
            ->where($where)
            ->page($page, $pageSize)
            ->order("seconds asc")
            ->select();
        foreach($list as &$val) {
            $val['options'] = json_decode($val['options'], true);
        }
        $total = Db("video_subject")
            ->where($where)
            ->count();
        return success("获取成功", $list, $page, $total);
    }

    /**
     * Notes:更新答题
     */
    public function saveSubject(){
        $id = intval(input('id'));
        $vid = intval(input('vid'));
        $seconds = intval(input('seconds'));
        $title = input('title');
        $options = input('options/a');
        
        $true_answer = intval(input('true_answer'));
        $gold = intval(input('gold', 0));
        $status = input('status') ? 1:0;
        if(empty($vid)){
            return error("视频ID不能为空");
        }
        if(empty($seconds)){
            return error("出题秒数不能为空");
        }
        if(empty($title)){
            return error("标题不能为空");
        }
        $data = [
            'vid'           => $vid,
            'seconds'       => $seconds,
            'title'         => $title,
            'options'       => json_encode($options),
            'true_answer'   => $true_answer,
            'gold'          => $gold,
            'status'        => $status,
            'update_time'   => time(),
            'create_time'   => time()
        ];
        if ($id) {
            $res = Db("video_subject")->where(['id' => $id])->update($data);
        } else {
            $res = Db("video_subject")->insert($data);
        }
        if(!$res) {
            return error("保存失败");
        }
        u_log("修改题目 {$vid}成功");
        return success("保存成功");
    }

    /**
     * Notes:更新视频是否开启答题
     */
    public function isSubject(){
        $vid = input('vid');
        $status = (input('status') == 'true') ? 1:0;
        if(empty($vid)){
            return error("视频ID不能为空");
        }
        $data = [
            'is_subject' => $status
        ];
        $res = Db("video")->where(['id' => $vid])->update($data);
        if(!$res) {
            return error("修改失败");
        }
        u_log("修改视频 {$vid}是否出题({$status})成功");
        return success("修改成功");
    }
}