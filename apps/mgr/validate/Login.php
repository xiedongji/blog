<?php
namespace app\mgr\validate;

use think\Validate;

/**
 * 后台登录验证
 * Class Login
 * @package app\admin\validate
 */
class Login extends Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require',
        'verify'   => 'require'
        // 'verify'   => 'require|captcha'
    ];

    protected $message = [
        'username.require' => '请输入用户名',
        'password.require' => '请输入密码',
        'verify.require'   => '请输入验证码',
        // 'verify.captcha'   => '验证码不正确'
    ];
}