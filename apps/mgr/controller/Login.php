<?php
namespace app\mgr\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Session;

/**
 * 后台登录
 * Class Login
 * @package app\admin\controller
 */
class Login extends Controller
{
    /**
     * 后台登录
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 登录验证
     * @return string
     */
    public function login()
    {
        if ($this->request->isPost()) {
            $data            = $this->request->only(['username', 'password', 'verify']);
            $validate_result = $this->validate($data, 'Login');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $where['username'] = $data['username'];
                $where['password'] = md5($data['password'] . Config::get('salt'));

                $sys_user = Db::name('sys_user')->field('id,username,status')->where($where)->find();

                if (!empty($sys_user)) {
                    if ($sys_user['status'] != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $sys_user['id']);
                        Session::set('admin_name', $sys_user['username']);
                        Db::name('sys_user')->update(
                            [
                                'last_login_time' => date('Y-m-d H:i:s', time()),
                                'last_login_ip'   => $this->request->ip(),
                                'id'              => $sys_user['id']
                            ]
                        );
                        $this->success('登录成功', 'mgr/index/index');
                    }

                } else {
                    $this->error('用户名或密码错误');
                }
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        Session::delete('admin_id');
        Session::delete('admin_name');
        $this->success('退出成功', 'mgr/login/index');
    }
}
