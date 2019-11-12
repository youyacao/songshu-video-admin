<?php


namespace app\admin\controller;


use app\api\controller\Type;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\Config;
use think\Controller;

class Api extends Controller
{

    /**
     * Notes:上传公共接口
     * 在config.php文件中配置use_qiniu选项调节是否开启七牛云上传功能
     * @param type 上传类型  可选（video，img），可通过api/config.php文件进行配置上传类型以及其后缀
     * User: BigNiu
     * Date: 2019/10/8
     * Time: 16:01
     * @return \think\response\Json
     * @throws \Exception
     */
    public function upload()
    {
        //dump(Config::has('use_qiniu'));exit;
        //如果开启使用七牛云上传
        if (Config::get("use_qiniu")) {
            return $this->upload_qiniu();
        }
        $type = input("type");
        $config = Config::get($type);
        if (!$config) {
            return error("上传类型错误");
        }
        // 获取表单上传视频 例如上传了001.mp4
        $file = request()->file('file');
        if (!$file) {
            return error("请选择上传文件");
        }
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['ext' => $config['ext']])->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'uploads' . DS . $type);

        if ($info) {
            $url = 'uploads/' . $type . "/" . str_replace(DS, "/", $info->getSaveName());
            if ($type == 'video') {
                $data = [
                    'url' => $url,
                    'img' => getImg($url)
                ];
                return success("上传成功", $data);
            } else {
                $data = [
                    'url' => $url
                ];
                return success("上传成功", $data);
            }
            //上传成功返回路径

        } else {
            // 上传失败获取错误信息
            return error($file->getError());
        }
    }

    /**
     * Notes:七牛云上传
     * User: BigNiu
     * Date: 2019/10/8
     * Time: 16:00
     * @return \think\response\Json 图片完整URL
     * @throws \Exception
     */
    public function upload_qiniu()
    {
        if (request()->isPost()) {
            $file = request()->file('file');
            // 要上传图片的本地路径
            $filePath = $file->getRealPath();
            $ext = pathinfo($file->getInfo('name'), PATHINFO_EXTENSION);  //后缀
            //获取当前控制器名称
            // 上传到七牛后保存的文件名
            $key = substr(md5($file->getRealPath()), 0, 5) . date('YmdHis') . rand(0, 9999) . '.' . $ext;
            require_once APP_PATH . '/../vendor/qiniu/autoload.php';
            // 需要填写你的 Access Key 和 Secret Key
            $accessKey = Config::get('ACCESSKEY');
            $secretKey = Config::get('SECRETKEY');
            // 构建鉴权对象
            $auth = new Auth($accessKey, $secretKey);
            // 要上传的空间
            $bucket = Config::get('BUCKET');
            $domain = Config::get('DOMAIN');
            $token = $auth->uploadToken($bucket);
            // 初始化 UploadManager 对象并进行文件的上传
            $uploadMgr = new UploadManager();
            // 调用 UploadManager 的 putFile 方法进行文件的上传
            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
            if ($err !== null) {
                return error($err);
            } else {
                //返回图片的完整URL
                return success("上传成功", "http://" . $domain . "/" . $ret['key']);
            }
        }
    }
}