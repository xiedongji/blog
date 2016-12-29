<?php
// +----------------------------------------------------------------------
// | Author: Simon <10021298@qq.com> SimonTeam
// +----------------------------------------------------------------------
// | Version: Release:1.0
// +----------------------------------------------------------------------
// | Note:Mgr平台 基础 控制器
// +----------------------------------------------------------------------

namespace app\mgr\controller;

use app\common\controller\Base;
use think\auth\Auth;
use think\Loader;
use think\Cache;
use think\Controller;
use think\Db;
use think\Session;


 class BaseMgr extends Base
 {

     protected function _initialize() {
        parent::_initialize();

        $this->checkAuth();
        $this->getMenu();

        // 输出当前请求控制器（配合后台侧边菜单选中状态）
        $this->assign('controller', Loader::parseName($this->request->controller()));
    }

     /**
     * 权限检查
     * @return bool
     */
    protected function checkAuth() {

        // if (!Session::has('admin_id')) {
        //     $this->redirect('mgr/login/index');
        // }

        // $module     = $this->request->module();
        // $controller = $this->request->controller();
        // $action     = $this->request->action();

        // // 排除权限
        // $not_check = ['mgr/Index/index', 'mgr/AuthGroup/getjson', 'mgr/System/clear'];

        // if (!in_array($module . '/' . $controller . '/' . $action, $not_check)) {
        //     $auth     = new Auth();
        //     $admin_id = Session::get('admin_id');
        //     if (!$auth->check($module . '/' . $controller . '/' . $action, $admin_id) && $admin_id != 1) {
        //         $this->error('没有权限');
        //     }
        // }
    }

    /**
     * 获取侧边栏菜单
     */
    protected function getMenu() {
        $menu     = [];
        $admin_id = Session::get('admin_id');
        $auth     = new Auth();

        $mgr_menu_list = Db::name('sys_menu')->where('status', 1)->order(['sort' => 'desc', 'id' => 'asc'])->select();

        //根据权限 过滤相应菜单
        foreach ($mgr_menu_list as $menu_item) {
            // if ($auth->check($menu_item['name'], $admin_id) || $admin_id == 1) {
                $menu[] = $menu_item;
            // }
        }
        $menu = !empty($menu) ? array2tree($menu) : [];

        $this->assign('menu', $menu);
    }


 }