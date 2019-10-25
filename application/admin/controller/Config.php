<?php


namespace app\admin\controller;


class Config extends Admin
{
    public function getConfig(){
        $config = Db("config")->field(['name','value'])->select();
        $arr = [];
        foreach ($config as $key=>$value){
            $arr[$value['name']]=$value['value'];
        }
        return success("获取成功",$arr);
    }
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