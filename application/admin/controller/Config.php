<?php


namespace app\admin\controller;


class Config extends Admin
{
    /**
     * Notes:获取配置信息
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:18
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getConfig(){
        $config = Db("config")->field(['name','value'])->select();
        $arr = [];
        foreach ($config as $key=>$value){
            $arr[$value['name']]=$value['value'];
        }
        return success("获取成功",$arr);
    }

    /**
     * Notes:设置配置信息
     * User: BigNiu
     * Date: 2019/10/31
     * Time: 14:18
     * @return \think\response\Json
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function setConfig(){
        $config = input("config/a");
        if(!$config||sizeof($config)==0){
            return success("保存成功");
        }
        foreach($config as $key=>$value){
            if(is_array($value)){
                $value = json_encode($value);
            }
            _config($key,$value);
        }
        return success("保存成功");

    }
}