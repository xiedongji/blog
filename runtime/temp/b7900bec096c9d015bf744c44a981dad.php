<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:63:"D:\phpStudy\WWW\blog\public/../apps/mgr\view\article\index.html";i:1480992184;s:54:"D:\phpStudy\WWW\blog\public/../apps/mgr\view\base.html";i:1481076134;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>消息管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/css/font-awesome.min.css">
    <!--CSS引用-->
    
    <link rel="stylesheet" href="/static/css/admin.css">
    <!--[if lt IE 9]>
    <script src="/static/js/html5shiv.min.js"></script>
    <script src="/static/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <!--头部-->
    <div class="layui-header header">
        <a href=""><img class="logo" src="/static/images/admin_logo.png" alt=""></a>
        <div class="user-action">
            <a href="javascript:;"><?php echo session('admin_name'); ?></a>
            <a class="" href="<?php echo url('mgr/login/logout'); ?>">退出</a>
        </div>
    </div>

    <!--侧边栏-->
    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <li class="layui-nav-item layui-nav-title"><a>管理菜单</a></li>
                <li class="layui-nav-item">
                    <a href="/index.php/mgr/index/index"><i class="fa fa-home"></i> 网站概览</a>
                </li>
                <li class="layui-nav-item">
                    <a href="" data-url="/index.php/mgr/system/clear" id="clear-cache"><i class="fa fa-trash-o"></i> 清除缓存</a>
                </li>
                <?php if(is_array($menu) || $menu instanceof \think\Collection): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): if(isset($vo['children'])): ?>
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="<?php echo $vo['icon']; ?>"></i> <?php echo $vo['title']; ?></a>
                    <?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$v): ?>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="<?php echo url($v['name']); ?>"> <?php echo $v['title']; ?></a>
                        </dd>
                    </dl>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </li>
                <?php else: ?>
                <li class="layui-nav-item">
                    <a href="<?php echo url($vo['name']); ?>"><i class="<?php echo $vo['icon']; ?>"></i> <?php echo $vo['title']; ?></a>
                </li>
                <?php endif; endforeach; endif; else: echo "" ;endif; ?>

                <li class="layui-nav-item" style="height: 30px; text-align: center"></li>
            </ul>
        </div>
    </div>

    <!--主体-->
    
<div class="layui-body">
    <!--tab标签-->
    <div class="layui-tab layui-tab-brief">
        <ul class="layui-tab-title">
            <li class="layui-this">文章管理</li>
            <li class=""><a href="<?php echo url('mgr/article/add'); ?>">添加文章</a></li>
        </ul>
        <div class="layui-tab-content">

            <form class="layui-form layui-form-pane" action="<?php echo url('mgr/article/index'); ?>" method="get">
                <div class="layui-inline">
                    <label class="layui-form-label">分类</label>
                    <div class="layui-input-inline">
                        <select name="cid">
                            <option value="0">全部</option>
                            <?php if(is_array($category_level_list) || $category_level_list instanceof \think\Collection): if( count($category_level_list)==0 ) : echo "" ;else: foreach($category_level_list as $key=>$vo): ?>
                            <option value="<?php echo $vo['id']; ?>" <?php if($cid==$vo['id']): ?> selected="selected"<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' ----';} endif; ?> <?php echo $vo['name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">关键词</label>
                    <div class="layui-input-inline">
                        <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="请输入关键词" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn">搜索</button>
                </div>
            </form>
            <hr>

            <form action="" method="post" class="ajax-form">
                <button type="button" class="layui-btn layui-btn-small ajax-action" data-action="<?php echo url('mgr/article/toggle',['type'=>'audit']); ?>">审核</button>
                <button type="button" class="layui-btn layui-btn-warm layui-btn-small ajax-action" data-action="<?php echo url('mgr/article/toggle',['type'=>'cancel_audit']); ?>">取消审核</button>
                <button type="button" class="layui-btn layui-btn-danger layui-btn-small ajax-action" data-action="<?php echo url('mgr/article/delete'); ?>">删除</button>
                <div class="layui-tab-item layui-show">
                    <table class="layui-table">
                        <thead>
                        <tr>
                            <th style="width: 15px;"><input type="checkbox" class="check-all"></th>
                            <th style="width: 30px;">ID</th>
                            <th style="width: 30px;">排序</th>
                            <th>标题</th>
                            <th>栏目</th>
                            <th>作者</th>
                            <th>阅读量</th>
                            <th>状态</th>
                            <th>发布时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($article_list) || $article_list instanceof \think\Collection): if( count($article_list)==0 ) : echo "" ;else: foreach($article_list as $key=>$vo): ?>
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="<?php echo $vo['id']; ?>"></td>
                            <td><?php echo $vo['id']; ?></td>
                            <td><?php echo $vo['sort']; ?></td>
                            <td><?php echo $vo['title']; ?></td>
                            <td><?php echo $category_list[$vo['cid']]; ?></td>
                            <td><?php echo $vo['author']; ?></td>
                            <td><?php echo $vo['reading']; ?></td>
                            <td><?php echo $vo['status']==1 ? '已审核' : '未审核'; ?></td>
                            <td><?php echo $vo['publish_time']; ?></td>
                            <td>
                                <a href="<?php echo url('mgr/article/edit',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-normal layui-btn-mini">编辑</a>
                                <a href="<?php echo url('mgr/article/delete',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-danger layui-btn-mini ajax-delete">删除</a>
                            </td>
                        </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <!--分页-->
                    <?php echo $article_list->render(); ?>
                </div>
            </form>
        </div>
    </div>
</div>


    <!--底部-->
    <div class="layui-footer footer">
        <div class="layui-main">
            <p>2016 &copy; <a href="http://www.jrzhuxue.com" target="_blank">加上助学</a></p>
        </div>
    </div>
</div>

<!--JS引用-->
<script src="/static/js/jquery.min.js"></script>
<script src="/static/layui/layui.js"></script>


<script>
    // 定义全局JS变量
    var GV = {
        current_controller: "mgr/<?php echo $controller; ?>"
    };

    layui.config({
        base: '/static/js/'
    }).use('admin');

</script>

<!--页面JS脚本-->

</body>
</html>