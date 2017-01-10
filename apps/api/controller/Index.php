<?php
// +----------------------------------------------------------------------
// | Author: Simon <10021298@qq.com>
// +----------------------------------------------------------------------
// | Version: ver1.0
// +----------------------------------------------------------------------
// | Note:接口默认
// +----------------------------------------------------------------------
namespace app\api\controller;

use app\common\controller\ApiBase;
use think\Db;
use think\Config;

class Index extends ApiBase
{

    /*=====================================================
     * 说明:默认 by:Simon
     *====================================================*/
    public function index()
    {
        Config::set('default_return_type','html');
        return $this->fetch();
    }
}
