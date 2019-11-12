<?php


namespace app\admin\controller;


class Advert extends Admin
{
    PUBLIC function getList(){
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);
        $name = input('name');
        $type = input('type/i');
        $where=[];
        if ($name) {
            $where = [
                'name' => ['like', "%{$name}%"],
                'title' => ['like', "%{$name}%"],
            ];
        }
        $whereType =[];
        if($type){
            $whereType=['type'=>$type];
        }
        $advert = Db("advert")->where($whereType)->whereOr($where)->page($page, $pageSize)->order('end_time')->select();
        $count = Db("advert")->where($whereType)->whereOr($where)->count();
        if($advert){
            return success("成功",$advert,$page,$count);
        }
        return error("失败");
    }
    public function add(){
        $type =   input("type/i",1);//广告类型 1:启动图广告，2:视频广告,3:弹窗霸屏广告,4:首页四屏广告
        $name = input("name","未命名商户");//商户名称
        $img = input("img");//推广广告图片
        $url = input("url","");//视频播放链接
        $open_type = input("open_type/i",2);//打开方式
        $end_time = input("end_time");//到期时间
        $ad_url = input("ad_url");//广告推广链接
        $title = input("title","未命名广告");//标题
        $state = input("state",1);//状态 1 启动 0 禁用
        if(!$type){
            return error("请选择分类");
        } if(!$ad_url){
            return error("请填写推广链接地址");
        }
        $data = [];
        switch ($type){
            case 1:
            case 3:
            case 4:
                //图片类型广告
                if(!$img){
                    return error("请上传推广图片");
                }
                $data = [
                  'type'=>$type,
                  'name'=>$name,
                  'img'=>$img,
                  'open_type'=>$open_type,
                  'create_time'=>TIME,
                  'end_time'=>$end_time,
                  'ad_url'=>$ad_url,
                  'title'=>$title,
                  'state'=>$state,
                ];
                break;
            case 2:
                //视频广告类型
                if(!$img){
                    return error("请上传推广图片");
                }
                if(!$url){
                    return error("请上传推广视频");
                }
                $data = [
                    'type'=>$type,
                    'name'=>$name,
                    'img'=>$img,
                    'url'=>$url,
                    'open_type'=>$open_type,
                    'create_time'=>TIME,
                    'end_time'=>$end_time,
                    'ad_url'=>$ad_url,
                    'title'=>$title,
                    'state'=>$state,
                ];
        }
        if(sizeof($data)<1){
            return error("添加失败");
        }
        $id = Db("advert")->insertGetId($data);
        if($id){
            $data['id']=$id;
            return success("添加成功",$data);
        }
        return error("添加失败");
    }
    public function update(){
        $id = input('id/i','0');
        $advert= Db("advert")->where(['id'=>$id])->find();
        if(!$advert){
            return error("该广告已被删除");
        }
        $data = input('post.');
        unset($data['id']);
        $res = Db("advert")->where(['id'=>$id])->update($data);
        if($res){
            return success("修改成功");
        }
        return error("修改失败");

    }
    public function delete(){
        $ids = input('ids/a');
        u_log("删除广告(".implode($ids,',')."成功");
        Db("advert")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }
}