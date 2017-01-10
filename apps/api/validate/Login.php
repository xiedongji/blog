<?php
namespace app\api\validate;

use think\Validate;

/**
* 后台登陆验证
*/
class Login extends Validate
{

    protected $rule = [
        'uname'  => 'require',
        'pwd'    => 'require',
        // 'verify' => 'require',
    ];

    protected $message = [
        'uname.require'  => '请输入用户名',
        'pwd.require'    => '请输入密码',
        // 'verify.require' => '请输入验证码',
    ];
}