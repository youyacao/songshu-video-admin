<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 生成不重复的随机数字
 * @param  int $start  需要生成的数字开始范围
 * @param  int $end    结束范围
 * @param  int $length 需要生成的随机数个数
 * @return number      生成的随机数
 */
function getRandNumber($start=0,$end=9,$length=8)
{
    //初始化变量为0
    $connt = 0;
    //建一个新数组
    $temp = array();
    while($connt < $length){
        //在一定范围内随机生成一个数放入数组中
        $temp[] = mt_rand($start, $end);
        //$data = array_unique($temp);
        //去除数组中的重复值用了“翻翻法”，就是用array_flip()把数组的key和value交换两次。这种做法比用 array_unique() 快得多。
        $data = array_flip(array_flip($temp));
        //将数组的数量存入变量count中
        $connt = count($data);
    }
    //为数组赋予新的键名
    shuffle($data);
    //数组转字符串
    $str=implode(",", $data);
    //替换掉逗号
    $number=str_replace(',', '', $str);
    return '1' . $number;
}

/**
 * 生成邀请码
 */
function createRefcode()
{
    $str = range('A', 'Z');
    $strs = range('a', 'z');
    unset($str[array_search('O', $str)]);
    unset($strs[array_search('o', $strs)]);
    $arr = array_merge(range(0, 9), $str, $strs);
    shuffle($arr);
    $invitecode = '';
    $arr_len = count($arr);
    for ($i = 0; $i < 6; $i++) {
        $rand = mt_rand(0, $arr_len - 1);
        $invitecode .= $arr[$rand];
    }
    return $invitecode;
}
