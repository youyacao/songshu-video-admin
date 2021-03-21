<?php


namespace app\admin\controller;


use think\Controller;
use think\exception\HttpResponseException;

class Admin extends Controller
{

    protected function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $admin = session('admin');
        // 这里的session 是当用户登录成功后创建的一个session 如果没有的话就代表没有用户登录
        // var_dump($uid);
        if($admin == null || $admin == "" || $admin == "null" || $admin == 0){
            throw new HttpResponseException(error("未登录"));
        }
        if(!$this->auth($admin)){
            throw new HttpResponseException(error("没有权限",1));
        }

    }

    /**
     * Notes:权限验证
     * User: BigNiu
     * Date: 2019/11/15
     * Time: 11:05
     * @param $admin
     * @return bool
     */
    private function auth($admin){
        $request= \think\Request::instance();

//        $module = $request->module();//模块名

        $controller = $request->controller();//控制器名

        $action = strtolower($request->action());//方法名
        $authGroup = [
            0=>[
                //广告模块
                'Advert'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'update'=>true,
                    'delete'=>true,
                ],
                //API接口模块
                'Api'=>[
                    'upload_qiniu'=>true,
                    'upload'=>true
                ],
                //评论模块
                'Comment'=>[
                    'getlist'=>true,
                    'del'=>true,
                    'update'=>true,
                ],
                //系统配置模块
                'Config'=>[
                    'getconfig'=>true,
                    'setconfig'=>true,
                ],
                //管理员模块
                'Manager'=>[
                    'getlist'=>true,
                    'adduser'=>true,
                    'updateuser'=>true,
                    'deleteuser'=>true,
                    'log'=>true,

                ],
                //分类模块
                'Type'=>[
                    'getlist'=>true,
                    'addtype'=>true,
                    'updatetype'=>true,
                    'delete'=>true,
                ],
                //APP更新模块
                'Update'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'update'=>true,
                    'delete'=>true,
                ],
                //用户模块
                'User'=>[
                    'getlist'=>true,
                    'invite'=>true,
                    'getinvitelist'=>true,
                    'getchangelist'=>true,
                    'getwithdrawlist'=>true,
                    'postwithdraw'=>true,
                    'getalllist'=>true,
                    'deleteuser'=>true,
                    'updateuser'=>true,
                    'userlog'=>true,
                ],
                //视频模块
                'Video'=>[
                    'getlist'=>true,
                    'deletevideo'=>true,
                    'updatevideo'=>true,
                    'addvideo'=>true,
                ],
                'Subject'=>[
                    'getlist'=>true,
                    'savesubject'=>true,
                    'issubject'=>true,
                ],
                //图文模块
                'TextImage'=>[
                    'getlist'=>true,
                    'delete'=>true,
                    'update'=>true,
                ],
                //卡密模块
                'Cipher'=>[
                    'getlist'=>true,
                    'delete'=>true,
                    'update'=>true,
                ],
                //订单模块
                'Order'=>[
                    'getlist'=>true
                ],
                //支付类型模块
                'PayType'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'delete'=>true,
                    'update'=>true,
                ],
                //VIP商品模块
                'VipShop'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'delete'=>true,
                    'update'=>true,
                ]

            ],
            1=>[
                //广告模块
                'Advert'=>[
                    'getlist'=>true,
                    'add'=>false,
                    'update'=>false,
                    'delete'=>false,
                ],
                //API接口模块
                'Api'=>[
                    'upload_qiniu'=>false,
                    'upload'=>false
                ],
                //评论模块
                'Comment'=>[
                    'getlist'=>true,
                    'del'=>false,
                    'update'=>false,
                ],
                //系统配置模块
                'Config'=>[
                    'getconfig'=>false,
                    'setconfig'=>false,
                ],
                //管理员模块
                'Manager'=>[
                    'getlist'=>false,
                    'adduser'=>false,
                    'updateuser'=>false,
                    'deleteuser'=>false,
                    'log'=>false,

                ],
                //分类模块
                'Type'=>[
                    'getlist'=>true,
                    'addtype'=>false,
                    'updatetype'=>false,
                    'delete'=>false,
                ],
                //APP更新模块
                'Update'=>[
                    'getlist'=>true,
                    'add'=>false,
                    'update'=>false,
                    'delete'=>false,
                ],
                //用户模块
                'User'=>[
                    'getlist'=>true,
                    'invite'=>false,
                    'getinvitelist'=>true,
                    'getchangelist'=>true,
                    'getwithdrawlist'=>true,
                    'postwithdraw'=>false,
                    'getalllist'=>true,
                    'deleteuser'=>false,
                    'updateuser'=>false,
                    'userlog'=>false,
                ],
                //视频模块
                'Video'=>[
                    'getlist'=>true,
                    'deletevideo'=>false,
                    'updatevideo'=>false,
                    'addvideo'=>false,
                ],
                'Subject'=>[
                    'getlist'=>true,
                    'savesubject'=>false,
                    'issubject'=>false,
                ],
                //图文模块模块
                'TextImage'=>[
                    'getlist'=>true,
                    'delete'=>false,
                    'update'=>false,
                ],
                //订单模块
                'Order'=>[
                    'getlist'=>true
                ],
                //支付类型模块
                'PayType'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'delete'=>true,
                    'update'=>true,
                ],
                //VIP商品模块
                'VipShop'=>[
                    'getlist'=>true,
                    'add'=>false,
                    'delete'=>false,
                    'update'=>false,
                ]
            ],2=>[
                //广告模块
                'Advert'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'update'=>true,
                    'delete'=>true,
                ],
                //API模块
                'Api'=>[
                    'upload_qiniu'=>true,
                    'upload'=>true
                ],
                //广告模块
                'Comment'=>[
                    'getlist'=>true,
                    'del'=>true,
                    'update'=>true,
                ],
                //配置模块
                'Config'=>[
                    'getconfig'=>false,
                    'setconfig'=>false,
                ],
                //管理员模块
                'Manager'=>[
                    'getlist'=>false,
                    'adduser'=>false,
                    'updateuser'=>false,
                    'deleteuser'=>false,
                    'log'=>false,

                ],
                //分类模块
                'Type'=>[
                    'getlist'=>true,
                    'addtype'=>true,
                    'updatetype'=>true,
                    'delete'=>true,
                ],
                //APP更新模块
                'Update'=>[
                    'getlist'=>true,
                    'add'=>false,
                    'update'=>false,
                    'delete'=>false,
                ],
                //用户模块
                'User'=>[
                    'getlist'=>true,
                    'invite'=>true,
                    'getinvitelist'=>true,
                    'getchangelist'=>true,
                    'getwithdrawlist'=>true,
                    'postwithdraw'=>true,
                    'getalllist'=>true,
                    'deleteuser'=>true,
                    'updateuser'=>true,
                    'userlog'=>true,
                ],
                //视频模块
                'Video'=>[
                    'getlist'=>true,
                    'deletevideo'=>true,
                    'updatevideo'=>true,
                    'addvideo'=>true,
                ],
                'Subject'=>[
                    'getlist'=>true,
                    'savesubject'=>true,
                    'issubject'=>true,
                ],
                //图文模块模块
                'TextImage'=>[
                    'getlist'=>true,
                    'delete'=>true,
                    'update'=>true,
                ],
                //订单模块
                'Order'=>[
                    'getlist'=>true
                ],
                //支付类型模块
                'PayType'=>[
                    'getlist'=>true,
                    'delete'=>false,
                    'update'=>false,
                ],
                //VIP商品模块
                'VipShop'=>[
                    'getlist'=>true,
                    'add'=>true,
                    'delete'=>true,
                    'update'=>true,
                ]
            ]
        ];
        //判断当前登录用户的权限是否包含0,1,2
        if(!$admin['group']||!in_array($admin['group']['role'],[0,1,2])){
            return false;
        }
        $role = $admin['group']['role'];
        $controllerRole = $authGroup[$role][$controller];
        //判断控制器是否存在
        if(!$controllerRole)
        {
            return false;
        }
        //判断是否有权限
        $actionRole = $controllerRole[$action];
        if(!$actionRole){
            return false;
        }

        return true;
    }

}