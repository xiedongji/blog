<?php
// +----------------------------------------------------------------------
// | Version: Release:1.0
// +----------------------------------------------------------------------
// | Note:自动生成模块脚本
// +----------------------------------------------------------------------
return [
    // // 生成应用公共文件
    // '__file__' => ['common.php', 'config.php', 'database.php'],

    // // 定义demo模块的自动生成 （按照实际定义的文件名生成）
    // 'mgr'     => [
    //     '__file__'   => ['common.php'],
    //     '__dir__'    => ['controller', 'model', 'view', 'validate'],
    //     'controller' => ['Index', 'Test'],
    //     'model'      => ['User'],
    //     'view'       => ['index/index'],
    // ],

    // 公共 控制器 存储路径
    'common'     => [
        '__dir__'    => ['controller'],
        'controller' => ['Global'],
    ],
];

