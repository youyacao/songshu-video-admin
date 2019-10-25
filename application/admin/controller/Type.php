<?php


namespace app\admin\controller;


class Type extends Admin
{
    public function getList(){
        $type1 = Db("type")->where(["level"=>1,"enable"=>1])->select();
        foreach ($type1 as $key=>$item)
        {
            $type2 = Db("type")->where(["pid"=>$item['id'],"enable"=>1])->select();
            $type1[$key]['sub_type']=$type2?$type2:[];
        }
        return success("成功",$type1);
    }
}