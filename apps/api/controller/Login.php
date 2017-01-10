<?php
// +----------------------------------------------------------------------
// | Author: Simon <10021298@qq.com>
// +----------------------------------------------------------------------
// | Version: ver1.0
// +----------------------------------------------------------------------
// | Note:接口默认
// +----------------------------------------------------------------------
namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Config;
use think\Session;

class Login extends Controller
{

    /*=====================================================
     * 登陆:默认 by:Simon
     *====================================================*/
    public function doIn()
    {
        if ($this->request->isPost()) {
            // $data     = $this->request->only(['uname','pwd','verify']);
            $data     = $this->request->only(['uname','pwd']);
            $checkRes = $this->validate($data,'Login');

            if ($checkRes !== true) {
                    $jsonData['code'] = '20';
                    $jsonData['msg']    = $checkRes;
                    $jsonData['res']    = '';
                    return json($jsonData);

            }else{
                $wh['username'] = $data['uname'];
                $wh['password'] = md5($data['pwd'].Config::get('salt'));

                $userInfo = Db::name('user')->field('id,username,status')->where($wh)->find();


                if (!empty($userInfo)) {
                    if ($userInfo['status'] != 1) {
                        $jsonData['code'] = '20';
                        $jsonData['msg']    = '当前用户已禁用';
                        $jsonData['res']    = '';
                        return json($jsonData);

                    }else{
                        Session::set('user_id', $userInfo['id']);
                        Session::set('user_name', $userInfo['username']);
                        Db::name('user')->update([
                            'last_login_time' => date('Y-m-d H:i:s', time()),
                            'last_login_ip'   => $this->request->ip(),
                            'id'              => $userInfo['id']
                        ]);
                    }

                    $jsonData['code'] = '10';
                    $jsonData['msg']    = '登录成功';
                    $jsonData['res']    = '';
                    return json($jsonData);
                    echo json_encode($jsonData);
                    exit;

                }else{
                    $jsonData['code'] = '20';
                    $jsonData['msg']    = '用户名或密码错误';
                    $jsonData['res']    = '';
                    return json($jsonData);
                }
            }
        }
    }
}