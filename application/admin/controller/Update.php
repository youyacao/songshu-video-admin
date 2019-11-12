<?php


namespace app\admin\controller;

/**
 * Class Update APP版本相关
 * @package app\admin\controller
 */
class Update extends Admin
{
    /**
     * Notes:获取APP版本列表
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:21
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getList()
    {
        $page = input("page/i", 1) <= 1 ? 1 : input("page/i", 1);
        $pageSize = input("pageSize/i", 10) <= 10 ? 10 : input("pageSize/i", 10);

        $userList = Db("update")->page($page, $pageSize)->select();

        $count = Db("update")->count();
        return success("获取成功", $userList, $page, $count);
    }

    /**
     * Notes:添加新版本
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:21
     * @return \think\response\Json
     */
    public function add(){
        $version = input("version");
        $appid = input('appid');
        $ios_download = input("ios_download");
        $android_download = input("android_download");
        $open_type = input("open_type",2);
        $content = input("content");
        if(!$version||!$appid||!$ios_download||!$android_download||!$open_type||!$content){
            return error("所有字段都为必填");
        }
        //判断添加的版本号是否符合规范
        $pattern = '/^\d+\.\d+.\d+$/';//需要转义/
        preg_match($pattern,$version,$match);
        if(!$match){
            return error("您的版本号不符合规范，格式为: 1.1.1");
        }
        //判断苹果下载地址是否符合规范
        $pattern = '/^http[s]?:\/\/\w+\.\w+\.\w+(.*?)/';//需要转义/
        preg_match($pattern,$ios_download,$match);
        if(!$match){
            return error("您的苹果下载地址不符合规范，需要以http://或https://开头的网址请重新填写");
        }
        //判断安卓下载地址是否符合规范
        preg_match($pattern,$android_download,$match);
        if(!$match){
            return error("您的安卓下载地址不符合规范，需要以http://或https://开头的网址请重新填写");
        }
        $update = Db("update")->where(['appid'=>$appid])->order('time desc')->find();

        //有最新版本，做版本号判断
        if($update){

            $newVersion=$update['version'];
            $newVersion = explode(".",$newVersion);

            $newVersion1 = $newVersion[0];
            $newVersion2 = $newVersion[1];
            $newVersion3 = $newVersion[2];

            $version_add = explode('.',$version);
            $version1 = $version_add[0];
            $version2 = $version_add[1];
            $version3 = $version_add[2];
            //主版本号大于当前版本
            if($newVersion1>$version1){
                return error("版本号错误，请输入比当前最大版本大的版本号");
            }
            if($newVersion1==$version1&&$newVersion2>$version2){
                return error("版本号错误，请输入比当前最大版本大的版本号");
            }
            if($newVersion1==$version1&&$newVersion2==$version2&&$newVersion3>$version3){
                return error("版本号错误，请输入比当前最大版本大的版本号");
            }
            if($newVersion1==$version1&&$newVersion2==$version2&&$newVersion3==$version3){
                return error("版本号错误，请输入比当前最大版本大的版本号");
            }
        }
        $data = [
            'version'=>$version,
            'appid'=>$appid,
            'ios_download'=>$ios_download,
            'android_download'=>$android_download,
            'open_type'=>$open_type,
            'content'=>$content,
            'time'=>TIME
        ];
        //插入数据
        $res = Db("update")->insert($data);
        if($res){
            return success("添加成功");
        }
        return error("添加失败");
    }

    /**
     * Notes:修改版本信息
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:21
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function update(){
        $id = input("id/i");
        $appid = input('appid');
        $ios_download = input("ios_download");
        $android_download = input("android_download");
        $open_type = input("open_type");
        $content = input("content");
        $data = [
            'appid'=>$appid,
            'ios_download'=>$ios_download,
            'android_download'=>$android_download,
            'open_type'=>$open_type,
            'content'=>$content,
            'time'=>TIME
        ];
        $res = Db("update")->where(['id'=>$id])->update($data);
        if($res){
            return success("修改成功");
        }
        return error("修改失败");
    }

    /**
     * Notes:删除版本
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:21
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function delete()
    {
        $ids = input('ids/a');
        u_log("删除更新记录(".implode($ids,',')."成功");
        Db("update")->whereIn('id', $ids)->delete();
        return success("删除成功");
    }
}