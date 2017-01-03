<?php
// +----------------------------------------------------------------------
// | Author: Simon <10021298@qq.com>
// +----------------------------------------------------------------------
// | Version: ver1.0
// +----------------------------------------------------------------------
// | Note:命令类 演示文件
// | 使用方式：php think
// +----------------------------------------------------------------------
namespace app\mgr\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class SimonCmd extends Command
{

    protected function configure()
    {
        //这设置 simonCmd 用于 命令行窗口 显示 ，后面是该命令的描述(不支持中文)
        $this->setName('simonCmd')->setDescription('Yahoo! This is Command mode!');
    }


    protected function execute(Input $input, Output $output)
    {
        $output->writeln("You can write your shell in here...From Simon ^_^!");
    }

}