/*
Navicat MySQL Data Transfer

Source Server         : LOC
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : in_cms

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-29 17:50:10
*/

SET FOREIGN_KEY_CHECKS=0;


-- ----------------------------
-- Table structure for t_article
-- ----------------------------
DROP TABLE IF EXISTS `t_article`;
CREATE TABLE `t_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `cid` smallint(5) unsigned NOT NULL COMMENT '分类ID',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `introduction` varchar(255) DEFAULT '' COMMENT '简介',
  `content` longtext COMMENT '内容',
  `author` varchar(20) DEFAULT '' COMMENT '作者',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0 待审核  1 审核',
  `reading` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读量',
  `thumb` varchar(255) DEFAULT '' COMMENT '缩略图',
  `photo` text COMMENT '图集',
  `template` varchar(50) DEFAULT '' COMMENT '文章模板',
  `is_top` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶  0 不置顶  1 置顶',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `publish_time` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of t_article
-- ----------------------------
INSERT INTO `t_article` VALUES ('1', '1', 'art', 'art', '<p>art</p>', 'art', '1', '0', '', null, '', '0', '0', '2016-12-29 17:11:18', '2016-12-29 17:10:48');

-- ----------------------------
-- Table structure for t_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_group`;
CREATE TABLE `t_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` varchar(255) NOT NULL COMMENT '权限规则ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='权限组表';

-- ----------------------------
-- Records of t_auth_group
-- ----------------------------
INSERT INTO `t_auth_group` VALUES ('1', '超级管理组', '1', '1,2,3,4,5,6,7,8,9,10,11,12,39,40,41,42,43,14,13,20,21,22,23,24,15,25,26,27,28,29,30,16,17,44,45,46,47,48,18,49,50,51,52,53,19,31,32,33,34,35,36,37');
INSERT INTO `t_auth_group` VALUES ('5', '测试组', '1', '1,2,3,4,5,6,7,9,12,39,41,14,13,20,22,15,25,27,30,16,17,44,46,18,49,51,19,31,33,36');

-- ----------------------------
-- Table structure for t_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `t_auth_group_access`;
CREATE TABLE `t_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限组规则表';

-- ----------------------------
-- Records of t_auth_group_access
-- ----------------------------
INSERT INTO `t_auth_group_access` VALUES ('1', '1');
INSERT INTO `t_auth_group_access` VALUES ('2', '5');
INSERT INTO `t_auth_group_access` VALUES ('3', '5');

-- ----------------------------
-- Table structure for t_column
-- ----------------------------
DROP TABLE IF EXISTS `t_column`;
CREATE TABLE `t_column` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `alias` varchar(50) DEFAULT '' COMMENT '导航别名',
  `content` longtext COMMENT '分类内容',
  `thumb` varchar(255) DEFAULT '' COMMENT '缩略图',
  `icon` varchar(20) DEFAULT '' COMMENT '分类图标',
  `template` varchar(50) NOT NULL DEFAULT '' COMMENT '分类模板',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '分类类型  1  列表  2 单页',
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of t_column
-- ----------------------------
INSERT INTO `t_column` VALUES ('1', '0', '测试分类', '', '', '', '', '', '1', '0');
INSERT INTO `t_column` VALUES ('2', '0', '栏目1', '栏目1', '<p>栏目1</p>', '', 'fa fa-home', '', '1', '0');

-- ----------------------------
-- Table structure for t_navbar
-- ----------------------------
DROP TABLE IF EXISTS `t_navbar`;
CREATE TABLE `t_navbar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL COMMENT '父ID',
  `name` varchar(20) NOT NULL COMMENT '导航名称',
  `alias` varchar(20) DEFAULT '' COMMENT '导航别称',
  `link` varchar(255) DEFAULT '' COMMENT '导航链接',
  `icon` varchar(255) DEFAULT '' COMMENT '导航图标',
  `target` varchar(10) DEFAULT '' COMMENT '打开方式',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态  0 隐藏  1 显示',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='导航表';

-- ----------------------------
-- Records of t_navbar
-- ----------------------------
INSERT INTO `t_navbar` VALUES ('1', '0', 'test', 'test', 'test', 'test', '_self', '1', '0');
INSERT INTO `t_navbar` VALUES ('2', '0', 'aa', '', '', '', '_self', '1', '0');

-- ----------------------------
-- Table structure for t_site_config
-- ----------------------------
DROP TABLE IF EXISTS `t_site_config`;
CREATE TABLE `t_site_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '配置项名称',
  `value` text NOT NULL COMMENT '配置项值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of t_site_config
-- ----------------------------
INSERT INTO `t_site_config` VALUES ('1', 'site_config', 'a:7:{s:10:\"site_title\";s:9:\"CMS系统\";s:9:\"seo_title\";s:9:\"SEO标题\";s:11:\"seo_keyword\";s:12:\"SEO关键字\";s:15:\"seo_description\";s:9:\"SEO说明\";s:14:\"site_copyright\";s:12:\"版权信息\";s:8:\"site_icp\";s:12:\"ICP备案号\";s:11:\"site_tongji\";s:12:\"统计代码\";}');

-- ----------------------------
-- Table structure for t_sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_menu`;
CREATE TABLE `t_sys_menu` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '规则名称',
  `title` varchar(20) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `pid` smallint(5) unsigned NOT NULL COMMENT '父级ID',
  `icon` varchar(50) DEFAULT '' COMMENT '图标',
  `sort` tinyint(4) unsigned NOT NULL COMMENT '排序',
  `condition` char(100) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='规则表';

-- ----------------------------
-- Records of t_sys_menu
-- ----------------------------
INSERT INTO `t_sys_menu` VALUES ('1', 'mgr/System/default', '系统配置', '1', '1', '0', 'fa fa-gears', '10', '');
INSERT INTO `t_sys_menu` VALUES ('2', 'mgr/System/siteConfig', '站点配置', '1', '1', '1', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('3', 'mgr/System/updateSiteConfig', '更新配置', '1', '0', '2', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('5', 'mgr/Menu/default', '菜单管理', '1', '1', '0', 'fa fa-bars', '20', '');
INSERT INTO `t_sys_menu` VALUES ('6', 'mgr/Menu/index', '后台菜单', '1', '1', '5', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('7', 'mgr/Menu/add', '添加菜单', '1', '0', '6', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('8', 'mgr/Menu/save', '保存菜单', '1', '0', '6', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('9', 'mgr/Menu/edit', '编辑菜单', '1', '0', '6', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('10', 'mgr/Menu/update', '更新菜单', '1', '0', '6', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('11', 'mgr/Menu/delete', '删除菜单', '1', '0', '6', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('12', 'mgr/Navbar/index', '导航管理', '1', '1', '5', '', '10', '');
INSERT INTO `t_sys_menu` VALUES ('13', 'mgr/Column/index', '栏目管理', '1', '1', '14', 'fa fa-sitemap', '0', '');
INSERT INTO `t_sys_menu` VALUES ('14', 'mgr/Content/default', '内容管理', '1', '1', '0', 'fa fa-file-text', '40', '');
INSERT INTO `t_sys_menu` VALUES ('15', 'mgr/Article/index', '文章管理', '1', '1', '14', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('16', 'mgr/User/default', '用户管理', '1', '1', '0', 'fa fa-users', '30', '');
INSERT INTO `t_sys_menu` VALUES ('17', 'mgr/User/index', '普通用户', '1', '1', '16', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('18', 'mgr/AdminUser/index', '管理员', '1', '1', '16', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('19', 'mgr/AuthGroup/index', '权限组', '1', '1', '16', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('20', 'mgr/Column/add', '添加栏目', '1', '0', '13', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('21', 'mgr/Column/save', '保存栏目', '1', '0', '13', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('22', 'mgr/Column/edit', '编辑栏目', '1', '0', '13', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('23', 'mgr/Column/update', '更新栏目', '1', '0', '13', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('24', 'mgr/Column/delete', '删除栏目', '1', '0', '13', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('25', 'mgr/Article/add', '添加文章', '1', '0', '15', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('26', 'mgr/Article/save', '保存文章', '1', '0', '15', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('27', 'mgr/Article/edit', '编辑文章', '1', '0', '15', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('28', 'mgr/Article/update', '更新文章', '1', '0', '15', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('29', 'mgr/Article/delete', '删除文章', '1', '0', '15', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('30', 'mgr/Article/toggle', '文章审核', '1', '0', '15', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('31', 'mgr/AuthGroup/add', '添加权限组', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('32', 'mgr/AuthGroup/save', '保存权限组', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('33', 'mgr/AuthGroup/edit', '编辑权限组', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('34', 'mgr/AuthGroup/update', '更新权限组', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('35', 'mgr/AuthGroup/delete', '删除权限组', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('36', 'mgr/AuthGroup/auth', '授权', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('37', 'mgr/AuthGroup/updateAuthGroupRule', '更新权限组规则', '1', '0', '19', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('39', 'mgr/Navbar/add', '添加导航', '1', '0', '12', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('40', 'mgr/Navbar/save', '保存导航', '1', '0', '12', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('41', 'mgr/Navbar/edit', '编辑导航', '1', '0', '12', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('42', 'mgr/Navbar/update', '更新导航', '1', '0', '12', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('43', 'mgr/Navbar/delete', '删除导航', '1', '0', '12', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('44', 'mgr/User/add', '添加用户', '1', '0', '17', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('45', 'mgr/User/save', '保存用户', '1', '0', '17', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('46', 'mgr/User/edit', '编辑用户', '1', '0', '17', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('47', 'mgr/User/update', '更新用户', '1', '0', '17', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('48', 'mgr/User/delete', '删除用户', '1', '0', '17', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('49', 'mgr/AdminUser/add', '添加管理员', '1', '0', '18', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('50', 'mgr/AdminUser/save', '保存管理员', '1', '0', '18', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('51', 'mgr/AdminUser/edit', '编辑管理员', '1', '0', '18', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('52', 'mgr/AdminUser/update', '更新管理员', '1', '0', '18', '', '0', '');
INSERT INTO `t_sys_menu` VALUES ('53', 'mgr/AdminUser/delete', '删除管理员', '1', '0', '18', '', '0', '');

-- ----------------------------
-- Table structure for t_sys_user
-- ----------------------------
DROP TABLE IF EXISTS `t_sys_user`;
CREATE TABLE `t_sys_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态 1 启用 0 禁用',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(20) DEFAULT NULL COMMENT '最后登录IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of t_sys_user
-- ----------------------------
INSERT INTO `t_sys_user` VALUES ('1', 'admin', 'b63ddacba6c3835cc1b250c5d9de6ac1', '1', '2016-10-18 15:28:37', '2016-12-28 18:23:03', '127.0.0.1');
INSERT INTO `t_sys_user` VALUES ('3', 'hots', '200820e3227815ed1756a6b531e7e0d2', '1', '2016-12-28 19:53:37', null, null);

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `mobile` varchar(11) DEFAULT '' COMMENT '手机',
  `email` varchar(50) DEFAULT '' COMMENT '邮箱',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户状态  1 正常  2 禁止',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登陆时间',
  `last_login_ip` varchar(50) DEFAULT '' COMMENT '最后登录IP',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', '普通用户', '200820e3227815ed1756a6b531e7e0d2', '', '', '1', '2016-11-25 10:24:20', null, '');
