<?php
namespace app\mgr\controller;

use app\mgr\model\SysMenu as SysMenuModel;
use think\Db;

/**
 * 后台菜单
 * Class Menu
 * @package app\mgr\ontroller
 */
class Menu extends BaseMgr {

    protected $sysMenuModel;

    protected function _initialize() {
        parent::_initialize();
        //初始化模型
        $this->sysMenuModel = new SysMenuModel();
    }

    /*=====================================================
     * 说明:上级菜单 兼 后台菜单管理 by:Simon
     *====================================================*/
    public function parentMenuList()
    {
        $admin_menu_list       = $this->sysMenuModel->order(['sort' => 'DESC', 'id' => 'ASC'])->select();
        $admin_menu_level_list = array2level($admin_menu_list);

        $this->assign('admin_menu_level_list', $admin_menu_level_list);
    }

    /**
     * 后台菜单
     * @return mixed
     */
    public function index() {
        $this->parentMenuList();
        return $this->fetch();
    }

    public function indexRoot() {
        $sysRootMenuList      = $this->sysMenuModel->order(['sort' => 'DESC', 'id' => 'ASC'])->where(['pid'=>0])->select();
        $sysRootMenuLevelList = array2level($sysRootMenuList);

        $this->assign('admin_menu_level_list', null);
        $this->assign('admin_menu_level_list', $sysRootMenuLevelList);
        return $this->fetch('index');
    }


    /**
     * 添加菜单
     * @param string $pid
     * @return mixed
     */
    public function add($pid = '') {
        $this->parentMenuList();
        return $this->fetch('add', ['pid' => $pid]);
    }

    /**
     * 保存菜单
     */
    public function save() {

        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Menu');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->sysMenuModel->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }
    }

    /**
     * 编辑菜单
     * @param $id
     * @return mixed
     */
    public function edit($id) {
        $this->parentMenuList();
        $admin_menu = $this->sysMenuModel->find($id);

        return $this->fetch('edit', ['admin_menu' => $admin_menu]);
    }

    /**
     * 更新菜单
     * @param $id
     */
    public function update($id) {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Menu');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->sysMenuModel->save($data, $id) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }
    }

    /**
     * 删除菜单
     * @param $id
     */
    public function delete($id) {
        if ($this->sysMenuModel->destroy($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}