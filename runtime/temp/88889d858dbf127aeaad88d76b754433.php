<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:68:"D:\phpStudy\WWW\blog\public/../apps/mgr\view\system\site_config.html";i:1480992370;s:54:"D:\phpStudy\WWW\blog\public/../apps/mgr\view\base.html";i:1481076134;}*/ ?>
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
            <li class="layui-this">站点配置</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" action="<?php echo url('mgr/system/updateSiteConfig'); ?>" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">网站标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[site_title]" value="<?php echo $site_config['site_title']; ?>" required  lay-verify="required" placeholder="请输入网站标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO标题</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[seo_title]" value="<?php echo $site_config['seo_title']; ?>" placeholder="请输入SEO标题" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO关键字</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[seo_keyword]" value="<?php echo $site_config['seo_keyword']; ?>" placeholder="请输入SEO关键字" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">SEO说明</label>
                        <div class="layui-input-block">
                            <textarea name="site_config[seo_description]" placeholder="请输入SEO说明" class="layui-textarea"><?php echo $site_config['seo_description']; ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">版权信息</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[site_copyright]" value="<?php echo $site_config['site_copyright']; ?>" placeholder="请输入版权信息" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">ICP备案号</label>
                        <div class="layui-input-block">
                            <input type="text" name="site_config[site_icp]" value="<?php echo $site_config['site_icp']; ?>" placeholder="请输入版权信息" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">统计代码</label>
                        <div class="layui-input-block">
                            <textarea name="site_config[site_tongji]" placeholder="请输入统计代码" class="layui-textarea"><?php echo $site_config['site_tongji']; ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
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